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
    var fallRisk;
    var fallRiskDetail;
    var sirkulasiAll;
    var neuroAll;
    var integumenAll;
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
    $(document).ready(function(e) {
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

    function makeid(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    }

    function get_bodyid() {
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "") + makeid(3);
        return bodyId;
    }

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

        generateSatelite()
        getAssessmentKeperawatan()
        getTindakanPerawat()
    })
    $("#assessmentigdTab").on("mouseup", function() {
        // getPainMonitoring()
        // getTriage()
        // getApgar()
        // getStabilitas()
    })
</script>

<script type="text/javascript">
    $(".formsavearpbtn").on('click', (function(e) {
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
                // $("#formsavearpbtn").hide()
                // $("#formeditarp").show()
                var isNewDocument = 0
                $.each(examForassessment, function(key, value) {
                    if (value.body_id == data.body_id) {
                        examForassessment[key] = data
                        isNewDocument = 1
                    }
                })
                if (isNewDocument == 1)
                    examForassessment.push(data)
                disableARP()
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
        addFallRisk(1, 0, 'arpbody_id', 'bodyFallRiskPerawat')
        addApgar(1, 0, 'arpbody_id', 'bodyApgarPerawat')
        addPainMonitoring(1, 0, 'arpbody_id', 'bodyPainMonitoringPerawat')
        addGizi(1, 0, 'arpbody_id', 'bodyGiziPerawat')
        addTriage(1, 0, 'arpbody_id', 'bodyTriagePerawat')
        addADL(1, 0, 'arpbody_id', 'bodyADLPerawat')
        addDekubitus(1, 0, 'arpbody_id', 'bodyDekubitusPerawat')
        addDerajatStabilitas(1, 0, 'arpbody_id', 'bodyStabilitasPerawat')
        addEducationForm(1, 0, 'arpbody_id', 'bodyEducationFormPerawat')
        addGcs(1, 0, 'arpbody_id', 'bodyGcsPerawat')
        addIntegumen(1, 0, 'arpbody_id', 'bodyIntegumenPerawat')
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
            processData: false,
            success: function(data) {
                examForassessment = data.examInfo
                riwayatAll = data.pasienHistory


                if (examForassessment.length > 0) {
                    // fillDataArp(examForassessment.length - 1)

                    displayTableAssessmentKeperawatan(examForassessment.length - 1)
                    displayTableAssessmentKeperawatanForVitalSign();
                    $("#arpAddDocument").hide()
                    $("#arpDocument").show()
                }
                $.each(examForassessment, function(key, value) {
                    if (value.vs_status_id == '1') {
                        fillDataArp(key)
                    }
                })
                fillRiwayatArp()
                disableARP()
            },
            error: function() {

            }
        });
    }

    function initialAddArp() {


        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#formaddarp").find("input, textarea").val(null)

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
        $("#arpvs_status_id").val(1)

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

        getFallRisk(ex.body_id)
        getPainMonitoring(ex.body_id)
        getTriage(ex.body_id, "bodyTriage")
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
            $("#arpGEN0009" + value.value_id).val(value.histories)
            $("#arpGEN0009" + value.value_id).prop("disabled", true)
        })
    }

    function signArp() {
        addSignUser("arp", "formsavearpbtnid")
    }

    function displayTableAssessmentKeperawatan(index) {
        $("#assessmentKeperawatanHistoryBody").html("")
        $("#cpptBody").html("")
        $.each(examForassessment, function(key, value) {
            if (value.vs_status_id == '1') {
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

            } else if (value.vs_status_id == '2' || value.vs_status_id == '7') {
                addRowCPPT(value, key)
            }
        })
    }

    function enableARP() {
        $(".formsavearpbtn").show()
        $(".formeditarp").hide()
        $(".formsignarp").show()
        $("#formaddarp input").prop("disabled", false)
        $("#formaddarp textarea").prop("disabled", false)
        $("#formaddarp select").prop("disabled", false)
        $("#vitalSignPerawat").find("button").click()
    }

    function disableARP() {
        $(".formsavearpbtn").hide()
        $(".formeditarp").show()
        $(".formsignarp").hide()
        $("#formaddarp input").prop("disabled", true)
        $("#formaddarp textarea").prop("disabled", true)
        $("#formaddarp select").prop("disabled", true)
        $("#vitalSignPerawat").find("button").click()
        $("#arpvalid_date")
        if ($("#arpvalid_date").val() != '' && $("#arpvalid_date").val() != null) {
            $(".formeditarp").hide()
            $(".formsignarp").hide()
        }
    }
    $(".formaddarpbtn").on("mouseup", function() {
        initialAddArp()
    })
</script>
<script type="text/javascript">
    function addRowDiagPerawat(diag_id = null, diag_name = null, diag_cat = null, diag_suffer = null) {
        diagIndex++;
        if (diag_cat == null) {
            diag_cat = 1
        }
        if (diag_cat == null && diagIndex > 1) {
            diag_cat = 2
        }
        $("#bodyDiagPerawat")
            .append($('<tr id="arpdiag' + diagIndex + '">')
                // .append($('<td>').html(diagIndex + "."))
                .append($('<td>')
                    .append('<select id="arpdiag_id' + diagIndex + '" class="form-control" name="diag_id[]" onchange="selectedDiagNurse(' + diagIndex + ')" style="width: 100%"></select>')
                    .append('<input id="arpdiag_name' + diagIndex + '" name="diag_name[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    .append('<input id="arpsscondition_id' + diagIndex + '" name="sscondition_id[]" placeholder="" type="text" class="form-control block" value="" style="display: none" />')
                    // .append($('<input>').attr('name', 'diag_id[]').attr('id', 'diag_id' + diagIndex).attr('value', diag_id).attr('type', 'text').attr('readonly', 'readonly'))
                )
                // .append($('<td>')
                //     .append($('<input>').attr('name', 'diag_name[]').attr('id', 'diag_name' + diagIndex).attr('value', diag_name).attr('type', 'text').attr('readonly', 'readonly'))
                // )
                .append($('<td>')
                    .append($("<select class=\"form-control\">")
                        .attr('name', 'suffer_type[]').attr('id', 'arpsuffer_type' + diagIndex) <?php foreach ($suffer as $key => $value) { ?>
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

        initializeDiagPerawatSelect2("arpdiag_id" + diagIndex, diag_id, diag_name)
        $("#arpsuffer_type" + diagIndex).val(0)
        $("#arpdiag_cat" + diagIndex).val(diagIndex)
    }

    function initializeDiagPerawatSelect2(theid, initialvalue = null, initialname = null, initialcat = null) {
        $("#" + theid).select2({
            placeholder: "Input Diagnosa",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisPerawatListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }

    function selectedDiagNurse(index) {
        var diagname = $("#arpdiag_id" + index).text()
        if (typeof diagname !== 'undefined') {
            $("#arpdiag_name" + index).val(diagname)
        }
    }
</script>
<script type='text/javascript'>
    $("#formeditfallriskbtn").on("click", function() {
        $("#formeditfallriskbtn").hide()
        $("#formsavefallriskbtn").show()
        $("#formfallrisk").find("iput, select, textarea").prop("disabled", true)
    })
    $("#formeditfallriskbtnmedis").on("click", function() {
        $("#formeditfallriskbtnmedis").hide()
        $("#formsavefallriskbtnmedis").show()
        $("#formfallriskmedis").find("iput, select, textarea").prop("disabled", true)
    })






    function addPainMonitoring(flag, index, document_id, container, isaddbutton = true) {
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '002') { ?>
                var documentId = $("#" + document_id).val()
                var bodyId = '';
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = painMonitoring[index].body_id
                }
                $("#" + container).append(
                    '<form id="formPainMonitoring' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Monitoring Nyeri' +
                    '</h4>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Apakah Nyeri:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    '<select class="form-control" name="parameter_id01" id="atypeASES02101' + bodyId + '" onchange="aValueParamPain(\'<?= $value['parent_id']; ?>\',this.value, \'' + bodyId + '\')">' +
                    <?php foreach ($aValue as $key => $value1) { ?> <?php if ($value1['parameter_id'] == '01' && $value1['p_type'] == 'ASES021') { ?> '<option value="<?= $value1['value_id']; ?>"><?= $value1['value_desc']; ?></option>' +
                        <?php } ?> <?php } ?> '</select>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Tanggal:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    '<input id="ases022examination_date" name="examination_date" type="datetime-local" class="form-control" value="' + get_date() + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<tbody id="bodyAssessment002' + bodyId + '">' +

                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Intervensi:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<tbody id="bodyAssessment002Intervensi' + bodyId + '">' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="panel-footer text-end mb-4">' +
                    '<button type="submit" id="formPainMonitoringSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formPainMonitoringEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                $("#formPainMonitoringEditBtn" + bodyId).on("click", function() {
                    $("#formPainMonitoringSaveBtn" + bodyId).show()
                    $("#formPainMonitoringEditBtn" + bodyId).hide()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)
                })

                $("#formPainMonitoring" + bodyId).append('<input name="org_unit_code" id="ases022org_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
                    .append('<input name="visit_id" id="ases022visit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
                    .append('<input name="trans_id" id="ases022trans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
                    .append('<input name="body_id" id="ases022body_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
                    .append('<input name="document_id" id="ases022document_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
                    .append('<input name="no_registration" id="ases022no_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
                    .append('<input name="clinic_id" id="ases022clinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
                    .append('<input name="employee_id" id="ases022employee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="petugas_id" id="ases022petugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
                    .append('<input name="class_room_id" id="ases022class_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
                    .append('<input name="bed_id" id="ases022bed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
                    .append('<input name="p_type" id="ases022p_type' + bodyId + '" type="hidden" value="ASES021" class="form-control" />')
                    .append('<input name="description" id="ases022description' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
                    .append('<input name="modified_date" id="ases022modified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
                    .append('<input name="modified_by" id="ases022modified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
                    .append('<input name="pain_monitoring_status" id="ases022pain_monitoring_status' + bodyId + '" type="hidden" value="" class="form-control" />')



                $("#formPainMonitoring" + bodyId).on('submit', (function(e) {
                    $("#ases022document_id" + bodyId).val($("#" + documentId).val())
                    let clicked_submit_btn = $(this).closest('form').find(':submit');
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rm/assessment/savePainMonitoring',
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
                            // $('#formPainMonitoring' + bodyId + ' input[type="radio"]:not(:checked)').prop("disabled", true)
                            // $('#formPainMonitoring' + bodyId + ' input[type="datetime-local"]').prop("readonly", true)
                            // $('#formPainMonitoring' + bodyId + ' option').prop("disabled", true)
                            $("#formPainMonitoringSaveBtn" + bodyId).hide()
                            $("#formPainMonitoringEdit" + bodyId).show()
                            $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)

                            clicked_submit_btn.button('reset');
                            // successMsg(data.message);
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
                $("#formPainMonitoringEdit" + bodyId).on("click", function() {
                    $("#formPainMonitoringSaveBtn" + bodyId).show()
                    $("#formPainMonitoringEdit" + bodyId).hide()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)
                })

                if (flag == 1) {
                    $("#formPainMonitoringSaveBtn" + bodyId).show()
                    $("#formPainMonitoringEditBtn" + bodyId).hide()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", false)
                } else {
                    $("#formPainMonitoringSaveBtn" + bodyId).hide()
                    $("#formPainMonitoringEditBtn" + bodyId).show()
                    $("#formPainMonitoring" + bodyId).find("input, textarea, select").prop("disabled", true)

                    $.each(painMonitoringDetil, function(key, value) {

                        if (value.p_type == 'ASES021' && value.body_id == bodyId && value.parameter_id == '01') {

                            $('#atypeASES02101' + bodyId).val(value.value_id)
                            // console.log($('#atypeASES02101' + bodyId).val())
                            // $('#atypeASES02101' + bodyId).prop("disabled", true)
                            $("#ases022body_id" + bodyId).val(bodyId)
                            // $('#formPainMonitoring' + bodyId + ' option').prop("disabled", true)
                            aValueParamPain('<?= $value['parent_id']; ?>', value.value_id, bodyId, flag)
                            aValueParamPain('<?= $value['parent_id']; ?>', $('#atypeASES02101' + bodyId).val(), bodyId, flag)
                            console.log($('#atypeASES02101' + bodyId).val())
                        } else {
                            aValueParamPain('<?= $value['parent_id']; ?>', value.p_type, bodyId, flag)
                        }
                    })
                }
            <?php } ?>
        <?php } ?>
        index++

        if (isaddbutton)
            $("#addPainMonitoringButton").html('<a onclick="addPainMonitoring(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function aValueParamPain(parent_id, p_type, body_id, flag) {
        $.each(avalue, function(key, value) {
            if (value.value_id == p_type) {
                p_type = value.value_info
            }
        })
        $("#bodyAssessment" + parent_id + body_id).html("")
        $("#bodyAssessment002Intervensi" + body_id).html("")
        var counter = 0;
        $.each(aparameter, function(key, value) {
            if (value.p_type == 'ASES021' && value.parameter_id != '01') {
                counter++;
                if (value.parameter_id != '05') {
                    $("#bodyAssessment" + parent_id + body_id).append(
                        '<tr>' +
                        '<td>' + counter + '.</td>' +
                        '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + '<i class="mdi mdi-arrow-right text-primary me-1"></i</h6></td>' +
                        '<td><div class="row" id="' + parent_id + value.p_type + value.parameter_id + body_id + '">' +
                        '</div></td>' +
                        '</tr>'
                    )
                } else {
                    $("#bodyAssessment" + parent_id + body_id).append(
                        '<tr>' +
                        '<td>' + counter + '.</td>' +
                        '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + '<i class="mdi mdi-arrow-right text-primary me-1"></i</h6></td>' +
                        '<td><select name="parameter_id05" class="form-control" id="' + parent_id + value.p_type + value.parameter_id + body_id + '">' +
                        '</select></td>' +
                        '</tr>'
                    )
                }

                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == 'ASES021' && value.parameter_id != '05') {
                        $("#" + parent_id + value.p_type + value.parameter_id + body_id).append(
                            '<div class="col-md-3"><div class="form-check mb-3"><input class="form-check-input" type="radio" name="parameter_id' + value1.parameter_id + '" id="parent_id' + parent_id + value1.value_id + body_id + '" value="' + value1.value_id + '" onchange="aValueParamScore(\'' + parent_id + '\', \'' + p_type + '\', \'' + value1.parameter_id + '\', ' + value1.value_score + ')"><label class="form-check-label" for="parent_id' + parent_id + value1.value_id + body_id + '">' + value1.value_desc + '</label></div></div>'
                        )
                    } else if (value.parameter_id == '05' && value1.parameter_id == '01' && value1.p_type == p_type) {
                        $("#" + parent_id + value.p_type + value.parameter_id + body_id).append(
                            '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                        )
                    }
                });
            }
            if (value.p_type == p_type) {
                if (p_type == 'ASES022' || p_type == 'ASES023' || p_type == 'ASES024') {
                    $("#bodyAssessment002Intervensi" + body_id).append(
                        '<thead>' +
                        '<tr>' +
                        '<th>Tanggal dan Jam Intervensi</th>' +
                        '<th>Intervensi</th>' +
                        '<th>Rute</th>' +
                        '<th>' + value.parameter_desc + '</th>' +
                        '<th>Re-Assessment</th>' +
                        '</tr>' +
                        ' </thead>' +

                        '<tr>' +
                        '<td>' +
                        '<input id="timeIntervensi' + body_id + '0" name="timeIntervensi[]" type="datetime-local" class="form-control" value="">' +
                        '<input id="reassessment_date' + body_id + '0" name="reassessment_date[]" type="datetime-local" class="form-control d-none" value="">' +
                        '</td>' +
                        '<td>' +
                        '<select id="intervensi' + body_id + '0" name="intervensi[]" type="text" class="form-control" value="">' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<select id="rute' + body_id + '0" name="rute[]" type="text" class="form-control" value="">' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<select id="painscalescore' + body_id + '0" name="painscalescore[]" type="text" class="form-control" value="">' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<select id="reAssessment' + body_id + '0" name="reAssessment[]" type="text" class="form-control" value="" onchange="setRescheduleIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', 0, this.value)">' +
                        // '<option value="">5 Menit</option>' +
                        // '<option value="">30 Menit</option>' +
                        // '<option value="">1 Jam</option>' +
                        // '<option value="">4 Jam</option>' +
                        // '<option value="">8 Jam</option>' +
                        // '<option value="">Nyeri Teratasi</option>' +
                        '</select>' +
                        '</td>' +
                        '</tr>' +
                        '<tr id="divBtnIntervensi' + body_id + '">' +
                        '<td colspan="5">' +
                        '<div class="row mb-4">' +
                        '<div class="col-md-12">' +
                        '<div id="" class="box-tab-tools text-center">' +
                        '<a onclick="addIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', 0, 1)" class="btn btn-primary btn-sm" id="" style="width: 200px"><i class=" fa fa-plus"></i> Tambah Intervensi</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                    )


                    $.each(avalue, function(key1, value1) {
                        if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                            console.log(value1.parameter_id)
                            $("#painscalescore" + body_id + '0').append(
                                '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                            )
                        }
                    });
                    var initialDate = new Date();
                    // Set the initial date to two hours ahead
                    initialDate.setHours(initialDate.getHours());

                    var timeZoneOffsetMinutes = initialDate.getTimezoneOffset();

                    // Adjust the date to the local time zone
                    initialDate.setMinutes(initialDate.getMinutes() - timeZoneOffsetMinutes);
                    // Format the initial date into a string compatible with the datetime-local input
                    var formattedInitialDate = initialDate.toISOString().slice(0, 16);

                    // Set the value of the input field to the formatted initial date
                    // document.getElementById("timeIntervensi" + body_id + '0').value = formattedInitialDate;
                    // document.getElementById("reassessment_date" + body_id + '0').value = formattedInitialDate;
                } else {
                    if (value.p_type == p_type) {
                        console.log(value.entry_type)

                        if (value.entry_type == 1) {
                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.column_name + '" placeholder=""></div>')
                            )
                        } else if (value.entry_type == 2) {
                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                    .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.column_name + '" placeholder=""></div>')

                                )
                            )
                            $.each(avalue, function(key1, value1) {
                                if (value1.p_type == value.p_type && value1.parameter_id == value.parameter_id && value1.value_score == '99') {
                                    $("#" + value.p_type + value.parameter_id + body_id)
                                        .append($('<div id="' + value.p_type + value.parameter_id + value1.value_id + 'group' + body_id + '"  class="row" style="display: none;">')
                                            .append('<label class="col-md-4 col-form-label mb-4">' + value1.value_desc + '</label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="' + value.p_type + value.parameter_id + value1.value_id + body_id + '" name="' + value.value_info + '" placeholder=""></div>')
                                        )
                                }
                            })
                        } else if (value.entry_type == 3) {
                            console.log("bodyAssessment002Intervensi" + body_id)

                            $("#bodyAssessment002Intervensi" + body_id).append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">' + value.parameter_desc + '</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<select id="' + value.p_type + value.parameter_id + body_id + '" name="' + value.p_type + value.parameter_id + '" class="form-control">')
                                        .append('<option>-</option>')
                                    )
                                )
                            )
                            $.each(avalue, function(key1, value1) {
                                if (value1.p_type == value.p_type && value1.parameter_id == value.parameter_id) {
                                    $("#" + value.p_type + value.parameter_id + body_id)
                                        // .append($('<div id="' + value.p_type + value.parameter_id + value1.value_id + 'group' + body_id + '"  class="row" style="display: none;">')
                                        .append('<option value="' + value1.value_score + '">' + value1.value_desc + '</option>')
                                }
                            })
                        }
                    }
                }

            }
        });
        $.each(avalue, function(key1, value1) {
            if (value1.parameter_id == '01' && value1.p_type == 'GEN0005') {
                $("#reAssessment" + body_id + '0').append(
                    '<option value="' + value1.value_score + '">' + value1.value_desc + '.</option>'
                )
            }
        });

        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0003') {
                $("#intervensi" + body_id + '0').append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0004') {
                $("#rute" + body_id + '0').append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        if (flag == '0') {
            $.each(painMonitoringDetil, function(key1, value1) {
                if (value1.body_id == body_id && value1.parameter_id != '05') {
                    $('[name="parameter_id' + value1.parameter_id + '"][value="' + value1.value_id + '"]').prop("checked", true)
                    $('[name="parameter_id' + value1.parameter_id + '"][type="radio"]:not(:checked)').prop("disabled", true)
                } else {
                    // $("#atypeASES02101" + body_id).val(value1.value_id)
                    // $('#atypeASES02101' + body_id + ' option').prop("disabled", true)
                }
                if (value1.p_type == p_type) {
                    $("#" + value1.p_type + value1.parameter_id + body_id).val(value1.value_score)
                }
            });
        }
        if (flag == '0') {
            if (p_type == 'ASES022' || p_type == 'ASES023' || p_type == 'ASES024') {
                $("#bodyAssessment002Intervensi" + body_id).html("")
                $.each(painMonitoringDetil, function(key1, value1) {
                    if (value1.body_id == body_id && value1.parameter_id != '05') {
                        $('[name="parameter_id' + value1.parameter_id + '"][value="' + value1.value_id + '"]').prop("checked", true)
                        $('[name="parameter_id' + value1.parameter_id + '"][type="radio"]:not(:checked)').prop("disabled", true)
                    } else {
                        $("#002ASES02105" + body_id).val(value1.value_id)
                        $('#002ASES02105' + body_id + ' option').prop("disabled", true)
                    }
                });
                $.each(painIntervensi, function(key1, value1) {
                    addIntervensi(parent_id, p_type, body_id, key1, flag)
                });
            } else {
                $("#bodyAssessment002Intervensi" + body_id).find("select, input, textarea").prop("disabled", true)
            }
        }
    }

    function addIntervensi(parent_id, p_type, body_id, lastIndex, flag) {
        var beforeIndex = lastIndex
        if (flag == 1) {
            lastIndex++
        }
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                $("#divBtnIntervensi" + body_id).remove()
                $("#bodyAssessment002Intervensi" + body_id).append(
                    '<thead>' +
                    '<tr>' +
                    '<th>Tanggal dan Jam Intervensi</th>' +
                    '<th>Intervensi</th>' +
                    '<th>Rute</th>' +
                    '<th>' + value.parameter_desc + '</th>' +
                    '<th>Re-Assessment</th>' +
                    '</tr>' +
                    ' </thead>' +

                    '<tr>' +
                    '<td>' +
                    '<input id="timeIntervensi' + body_id + '' + lastIndex + '" name="timeIntervensi[]" type="datetime-local" class="form-control" value="">' +
                    '<input id="reassessment_date' + body_id + '' + lastIndex + '" name="reassessment_date[]" type="datetime-local" class="form-control d-none" value="">' +
                    '</td>' +
                    '<td>' +
                    '<select id="intervensi' + body_id + '' + lastIndex + '" name="intervensi[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="rute' + body_id + '' + lastIndex + '" name="rute[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="painscalescore' + body_id + '' + lastIndex + '" name="painscalescore[]" type="text" class="form-control" value="">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<select id="reAssessment' + body_id + '' + lastIndex + '" name="reAssessment[]" type="text" class="form-control" value="" onchange="setRescheduleIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', ' + lastIndex + ', this.value)">' +
                    // '<option value="">5 Menit</option>' +
                    // '<option value="">30 Menit</option>' +
                    // '<option value="">1 Jam</option>' +
                    // '<option value="">4 Jam</option>' +
                    // '<option value="">8 Jam</option>' +
                    // '<option value="">Nyeri Teratasi</option>' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-check">' +
                    '<input class="form-check-input" type="checkbox" id="valid' + body_id + '' + lastIndex + '" checked="" name="valid[]">' +
                    '<label class="form-check-label" for="valid' + body_id + '' + lastIndex + '">Valid</label>' +
                    '</div>' +
                    '</td>' +
                    '</tr>' +
                    '<tr id="divBtnIntervensi' + body_id + '">' +
                    '<td colspan="5">' +
                    '<div class="row mb-4">' +
                    '<div class="col-md-12">' +
                    '<div id="" class="box-tab-tools text-center">' +
                    '<a onclick="addIntervensi(\'' + parent_id + '\', \'' + p_type + '\', \'' + body_id + '\', ' + lastIndex + ',1)" class="btn btn-primary btn-sm" id="" style="width: 200px"><i class=" fa fa-plus"></i> Tambah Intervensi</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</tr>'
                )
                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                        console.log(value1.parameter_id)
                        $("#painscalescore" + body_id + lastIndex).append(
                            '<option value="' + value1.value_id + '">[' + value1.value_score + '] ' + value1.value_desc + '.</option>'
                        )
                    }
                });
                // Get the value of the input field
                var date
                if (flag == 1) {
                    var inputDate = document.getElementById("reassessment_date" + body_id + beforeIndex).value;
                    date = new Date(inputDate);

                } else {
                    date = new Date();
                }

                // Parse the input date string into a JavaScript Date object

                // Get the local time zone offset in minutes
                var timeZoneOffsetMinutes = date.getTimezoneOffset();

                // Adjust the date to the local time zone
                date.setMinutes(date.getMinutes() - timeZoneOffsetMinutes);

                // Format the date into a string compatible with the datetime-local input
                var formattedDate = date.toISOString().slice(0, 16);

                // Update the value of the input field with the new date
                document.getElementById("timeIntervensi" + body_id + lastIndex).value = formattedDate
                document.getElementById("reassessment_date" + body_id + lastIndex).value = formattedDate
            }
        });

        $.each(avalue, function(key1, value1) {
            if (value1.parameter_id == '01' && value1.p_type == 'GEN0005') {
                $("#reAssessment" + body_id + '' + lastIndex).append(
                    '<option value="' + value1.value_score + '">' + value1.value_desc + '.</option>'
                )
            }
        });

        $.each(aparameter, function(key1, value1) {
            console.log("#intervensi" + body_id + lastIndex)
            if (value1.p_type == 'GEN0003') {
                $("#intervensi" + body_id + lastIndex).append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });
        $.each(aparameter, function(key1, value1) {
            if (value1.p_type == 'GEN0004') {
                $("#rute" + body_id + lastIndex).append(
                    '<option value="' + value1.parameter_id + '">' + value1.parameter_desc + '.</option>'
                )
            }
        });

        if (flag == '0') {
            intervensiData = painIntervensi[lastIndex]
            $("#timeIntervensi" + body_id + lastIndex).val(intervensiData.intervensi_date)
            $("#reassessment_date" + body_id + lastIndex).val(intervensiData.reassessment_date)
            $("#intervensi" + body_id + lastIndex).val(intervensiData.intervensi)
            $("#rute" + body_id + lastIndex).val(intervensiData.rute)
            $("#painscalescore" + body_id + lastIndex).val(intervensiData.value_id)
            $("#reAssessment" + body_id + lastIndex).val(intervensiData.reassessment)
            if (intervensiData.valid !== null) {
                $("#timeIntervensi" + body_id + lastIndex).prop("readonly", true)
                $("#reassessment_date" + body_id + lastIndex).prop("readonly", true)
                $("#intervensi" + body_id + lastIndex + " option").prop("disabled", true)
                $("#rute" + body_id + lastIndex + " option").prop("disabled", true)
                $("#painscalescore" + body_id + lastIndex + " option").prop("disabled", true)
                $("#reAssessment" + body_id + lastIndex + " option").prop("disabled", true)
            }
        }
    }

    function setRescheduleIntervensi(parent_id, p_type, body_id, index, thevalue) {
        // Get the value of the input field
        var inputDate = document.getElementById("timeIntervensi" + body_id + index).value;

        // Parse the input date string into a JavaScript Date object
        var date = new Date(inputDate);


        // Add two hours to the date
        date.setMinutes(date.getMinutes() + parseInt(thevalue));
        // Get the local time zone offset in minutes
        var timeZoneOffsetMinutes = date.getTimezoneOffset();

        // Adjust the date to the local time zone
        date.setMinutes(date.getMinutes() - timeZoneOffsetMinutes);

        // Format the date into a string compatible with the datetime-local input
        var formattedDate = date.toISOString().slice(0, 16);

        console.log(formattedDate)

        // Update the value of the input field with the new date
        document.getElementById("reassessment_date" + body_id + index).value = formattedDate
    }

    function getPainMonitoring(bodyId, container) {
        // $("#bodyPainMonitoring").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPainMonitoring',
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
                painMonitoring = data.painMonitoring
                painMonitoringDetil = data.painDetil
                painIntervensi = data.painIntervensi

                $.each(painMonitoring, function(key, value) {
                    $("#" + container).html("")
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyPainMonitoringPerawat").html("")
                        addPainMonitoring(0, key, 'arpbody_id', "bodyPainMonitoringPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyPainMonitoringMedis").html("")
                        addPainMonitoring(0, key, 'armpasien_diagnosa_id', "bodyPainMonitoringMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addTriage(flag, index, document_id, container, isaddbutton = true) {
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '004') { ?>
                var bodyId = '';
                var documentId = $("#" + document_id).val()
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = triage[index].body_id
                }
                $("#" + container).append(
                    '<form id="formTriage' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Triage' +
                    '</h4>' +
                    '<div class="row mt-4">' +
                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Jenis Triage:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<div class="form-check mb-3">' +
                    '<select class="form-control" name="p_type" id="aParamTriage' + bodyId + '" >' +
                    // '<select class="form-control" name="p_type" id="aParamTriage' + bodyId + '" onchange="aValueParamTriage(\'<?= $value['parent_id']; ?>\',this.value, \'' + bodyId + '\', 1)">' +
                    <?php foreach ($aType as $key1 => $value1) { ?> <?php if ($value1['parent_id'] == $value['parent_id']) { ?> '<option value="<?= $value1['p_type']; ?>"><?= $value1['p_description']; ?></option>' +
                        <?php } ?> <?php } ?> '</select>' +
                    '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 1:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Perlu tindakan <i>Live Saving/Resusitasi</i> segera?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '01') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000801" id="step1<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step1<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 2:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Resiko Tinggi, Kebingungan/Letargis/Disorientasi, Nyeri/Distress Berat?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '02') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000802" id="step2<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step2<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +

                    '<div class="col-md-3">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Step 3:</h5>' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<h5 class="font-size-14 mb-4">Berapa jenis sumber daya IGD yang dibutuhkan?</h5>' +
                    '<div class="row">' +
                    <?php foreach ($aValue as $key1 => $value1) {
                        if ($value1['p_type'] == 'GEN0008' && $value1['parameter_id'] == '03') { ?> '<div class="col-md-3">' +
                            '<div class="form-check mb-3">' +
                            '<input class="form-check-input" type="radio" name="gen000803" id="step3<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '" checked="" value="<?= $value1['value_id']; ?>">' +
                            '<label class="form-check-label" for="step3<?= $value1['parameter_id']; ?><?= $value1['value_id']; ?>' + bodyId + '"><?= $value1['value_desc']; ?></label>' +
                            '</div>' +
                            '</div>' +
                    <?php }
                    } ?> '</div>' +
                    '</div>' +


                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<tbody id="bodyAssessment004' + bodyId + '">' +

                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    `<div class="row">
                        <div class="col-md-3"><h5 class="font-size-14 mb-4 badge bg-primary">Score Triase:</h5>
                        </div>
                            <div class="col-md-9"><div class="form-check mb-3">
                                <select class="form-control" name="total_score" id="aTriageTotalScore` + bodyId + `">
                                    <option value="1">ATS 1</option>
                                    <option value="2">ATS 2</option>
                                    <option value="3">ATS 3</option>
                                    <option value="4">ATS 4</option>
                                    <option value="5">ATS 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    ` +
                    '<div class="panel-footer text-end mb-4">' +
                    '<button type="submit" id="formTriageSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formTriageEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-edit"></i> <span>Edit</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                $("#formTriageEditBtn" + bodyId).on("click", function() {
                    $("#formTriageSaveBtn" + bodyId).show()
                    $("#formTriageEditBtn" + bodyId).hide()
                    $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", false)
                })


                $("#formTriage" + bodyId).append('<input name="org_unit_code" id="triageorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
                    .append('<input name="visit_id" id="triagevisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
                    .append('<input name="trans_id" id="triagetrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
                    .append('<input name="body_id" id="triagebody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
                    .append('<input name="document_id" id="triagedocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
                    .append('<input name="no_registration" id="triageno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
                    .append('<input name="clinic_id" id="triageclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
                    .append('<input name="employee_id" id="triageemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="petugas_id" id="triagepetugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
                    .append('<input name="class_room_id" id="triageclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
                    .append('<input name="bed_id" id="triagebed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
                    .append('<input name="description" id="triagedescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
                    .append('<input name="modified_date" id="triagemodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
                    .append('<input name="modified_by" id="triagemodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
                    .append('<input name="p_type" id="triagep_type' + bodyId + '" type="hidden" value="" class="form-control" />')
                $("#formTriage" + bodyId).on('submit', (function(e) {
                    $("#triagedocument_id" + bodyId).val($("#" + document_id).val())
                    let clicked_submit_btn = $(this).closest('form').find(':submit');
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rm/assessment/saveTriage',
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
                            $('#formTriage' + bodyId).find("input, select, textarea").prop("disabled", true)
                            $('#formTriage' + bodyId + ' input[type="datetime-local"]').prop("readonly", true)
                            // $('#formTriage' + bodyId + ' option').prop("disabled", true)
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
                    $("#formTriageSaveBtn" + bodyId).show()
                    $("#formTriageEditBtn" + bodyId).hide()
                    $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", false)

                } else {
                    $.each(triageDetil, function(key, value) {
                        $("#formTriageSaveBtn" + bodyId).hide()
                        $("#formTriageEditBtn" + bodyId).show()
                        $("#formTriage" + bodyId).find("input, textarea, select").prop("disabled", true)

                        if (value.p_type == 'GEN0008' && value.body_id == bodyId) {
                            $('#aParamTriage' + bodyId).val(triage[index].p_type)
                            $('#aTriageTotalScore' + bodyId).val(triage[index].total_score)
                            $('#step1' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            $('#step2' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            $('#step3' + value.parameter_id + value.value_id + bodyId).prop("checked", true)
                            $('#formTriage' + bodyId + ' option').prop("disabled", true)
                            aValueParamTriage('<?= $value['parent_id']; ?>', triage[index].p_type, bodyId, flag)
                        }
                    })
                }
            <?php } ?>
        <?php } ?>
        index++
        if (isaddbutton)
            $("#addTriageButton").html('<a onclick="addTriage(1,' + index + ',\'' + document_id + '\', \'bodyTriageMedis\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")

    }

    function aValueParamTriage(parent_id, p_type, body_id, flag) {
        $("#triagep_type" + body_id).val(p_type)
        $("#bodyAssessment" + parent_id + body_id).html("")
        var counter = 0;
        $("#bodyAssessment" + parent_id + body_id).append(
            '<thead >' +
            '<tr id="theadAssessment' + parent_id + body_id + '">' +
            '</tr>' +
            ' </thead>' +
            '<tbody id="tbodyAssessment' + parent_id + body_id + '">' +
            '</tbody>'
        )
        $("#theadAssessment" + parent_id + body_id).append(
            '<th>PEMERIKSAAN</th>'
        )
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                $("#theadAssessment" + parent_id + body_id).append(
                    '<th id="theadAssessment' + parent_id + body_id + value.parameter_id + '">' + value.parameter_desc + '</th>'
                )
                if (value.parameter_id == '01') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color", "white")
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "red")
                } else if (value.parameter_id == '02' || value.parameter_id == '03') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "yellow")
                } else if (value.parameter_id == '04' || value.parameter_id == '05') {
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("color", "white")
                    $("#theadAssessment" + parent_id + body_id + value.parameter_id).css("background-color", "green")
                }

            }
        });

        $.each(avalue, function(key, value) {
            if (value.p_type == 'GEN0007') {
                $("#tbodyAssessment" + parent_id + body_id).append(
                    '<tr id="tbodyAssessment' + parent_id + body_id + value.value_id + '"><td>' + value.value_desc + '</td></tr>'
                )
                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == p_type) {
                        $("#tbodyAssessment" + parent_id + body_id + value.value_id).append(
                            '<td id="tbodyAssessment' + parent_id + body_id + value.value_id + value1.parameter_id + '"></td>'
                        )
                        $.each(avalue, function(key2, value2) {
                            if (value2.value_info == value.value_id && value2.parameter_id == value1.parameter_id && value2.p_type == p_type) {
                                console.log(value2.valie_id)
                                $("#tbodyAssessment" + parent_id + body_id + value.value_id + value1.parameter_id).append(
                                    '<div class="form-check mb-3">' +
                                    '<input name="val' + value2.value_id + '" class="form-check-input" type="checkbox" id="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' +
                                    '<label class="form-check-label" for="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' + value2.value_desc + '</label>' +
                                    '</div>'
                                )
                                $.each(triageDetil, function(key3, value3) {
                                    if (value3.value_id == value2.value_id) {
                                        $("#" + parent_id + body_id + value.value_id + value2.parameter_id + value3.value_id).prop("checked", true)
                                    }
                                })
                            }

                        });
                    }
                });

            }
        })

    }

    function getTriage(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getTriage',
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
                triage = data.triage
                triageDetil = data.triageDetil

                $.each(triage, function(key, value) {
                    console.log(value.document_id)
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyTriagePerawat").html("")
                        addTriage(0, key, "arpbody_id", "bodyTriagePerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyTriageMedis").html("")
                        addTriage(0, key, "armpasien_diagnosa_id", "bodyTriageMedis")
                    }

                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addApgar(flag, index, document_id, container) {
        <?php foreach ($aParent as $key => $value) { ?>
            <?php if ($value['parent_id'] == '005') { ?>
                var bodyId = '';
                var documentId = $("#" + document_id).val()
                if (flag == 1) {
                    const date = new Date();
                    bodyId = date.toISOString().substring(0, 23);
                    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
                } else {
                    bodyId = apgar[index].body_id
                }
                $("#" + container).append(
                    '<form id="formApgar' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
                    '<div class="card border border-1 rounded-4 m-4 p-4">' +
                    '<div class="card-body">' +
                    '<h4 class="card-title"> Apgar' +
                    '</h4>' +
                    '<div class="row mt-4">' +




                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
                    '</div>' +
                    '<table class="col-md-12 table table-striped">' +
                    '<thead>' +
                    '<tr id="headAssessment005' + bodyId + '"><th></th>' +
                    <?php foreach ($aType as $key1 => $value1) {
                        if ($value1['parent_id'] == '005') {
                            foreach ($aParameter as $key2 => $value2) {
                                if ($value2['p_type'] == $value1['p_type']) {

                    ?> '<th><?= $value2['parameter_desc']; ?>' +
                                    '</th>' +
                    <?php
                                }
                            }
                            break;
                        }
                    } ?> '</tr>' +
                    '</thead>' +
                    '<tbody id="bodyAssessment005' + bodyId + '">' +
                    <?php foreach ($aType as $key1 => $value1) {
                        if ($value1['parent_id'] == '005') {
                    ?> '<tr><td><?= $value1['p_description']; ?></td>' +
                            <?php
                            foreach ($aParameter as $key2 => $value2) {
                                if ($value2['p_type'] == $value1['p_type']) {

                            ?> '<td><select id="<?= $value['parent_id'] . $value1['p_type'] . $value2['parameter_id']; ?>' + bodyId + '" name="<?= $value['parent_id'] . $value1['p_type'] . $value2['parameter_id']; ?>" class="form-control">' +
                                    <?php foreach ($aValue as $key3 => $value3) {
                                        if ($value3['parameter_id'] == $value2['parameter_id'] && $value3['p_type'] == $value1['p_type']) {
                                    ?> '<option value="<?= $value3['value_id']; ?>"><?= $value3['value_desc']; ?></option>' +
                                    <?php
                                        }
                                    } ?> '</select></td>' +
                            <?php
                                }
                            }
                            ?> '</tr>' +
                    <?php
                        }
                    } ?> '</tr>' + '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="panel-footer text-end mb-4">' +
                    '<button type="submit" id="formApgarSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                    '<button style="margin-right: 10px" type="button" id="formApgarEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</form>'
                )

                $("#formApgarEditBtn" + bodyId).on("click", function() {
                    $("#formApgarSaveBtn" + bodyId).show()
                    $("#formApgarEditBtn" + bodyId).hide()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", false)
                })

                $("#formApgar" + bodyId).append('<input name="org_unit_code" id="apgarorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
                    .append('<input name="visit_id" id="apgarvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
                    .append('<input name="trans_id" id="apgartrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
                    .append('<input name="body_id" id="apgarbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
                    .append('<input name="document_id" id="apgardocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
                    .append('<input name="no_registration" id="apgarno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
                    .append('<input name="clinic_id" id="apgarclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
                    .append('<input name="employee_id" id="apgaremployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="petugas_id" id="apgarpetugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
                    .append('<input name="class_room_id" id="apgarclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
                    .append('<input name="bed_id" id="apgarbed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
                    .append('<input name="description" id="apgardescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
                    .append('<input name="modified_date" id="apgarmodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
                    .append('<input name="modified_by" id="apgarmodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
                    .append('<input name="p_type" id="apgarp_type' + bodyId + '" type="hidden" value="ASES032" class="form-control" />')
                $("#formApgar" + bodyId).on('submit', (function(e) {
                    $("#apgardocument_id" + bodyId).val($("#" + document_id).val())
                    let clicked_submit_btn = $(this).closest('form').find(':submit');
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rm/assessment/saveApgar',
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
                            $("#formApgarSaveBtn" + bodyId).hide()
                            $("#formApgarEditBtn" + bodyId).show()
                            $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", true)
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
                    $("#formApgarSaveBtn" + bodyId).show()
                    $("#formApgarEditBtn" + bodyId).hide()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", false)
                } else {
                    $("#formApgarSaveBtn" + bodyId).hide()
                    $("#formApgarEditBtn" + bodyId).show()
                    $("#formApgar" + bodyId).find("input, select, textarea").prop("disabled", true)

                    $.each(apgarDetil, function(key, value) {

                        if (value.body_id == bodyId) {
                            // console.log("#005" + value.p_type + value.parameter_id + value.body_id + "; valuenya:" + value.value_id)
                            $("#005" + value.p_type + value.parameter_id + value.body_id).val(value.value_id)
                        }
                    })
                }
            <?php } ?>
        <?php } ?>
        index++
        $("#addApgarButton").html('<a onclick="addApgar(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')

    }

    function aValueParamApgar(parent_id, p_type, body_id, flag) {
        $("#apgarp_type" + body_id).val(p_type)
        $("#bodyAssessment" + parent_id + body_id).html("")




        var counter = 0;
        <?php foreach ($aType as $key => $value) {
            if ($value['parent_id'] == '005') {
        ?>
        <?php
            }
        } ?>
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                $("#bodyAssessment005" + body_id).append(
                    '<tr id="' + parent_id + p_type + body_id + value.parameter_id + '">' +
                    '<td>' + value.parameter_desc +
                    '</td>' +
                    '</tr>'
                )
                $.each(avalue, function(key1, value1) {
                    $(parent_id + p_type + body_id + value.parameter_id).append(
                        '<td>'
                    )
                })
            }
        });

        $.each(avalue, function(key, value) {
            $("#tbodyAssessment" + parent_id + body_id).append(
                '<th>' + value.value_desc + '</th>'
            )
            if (value.p_type == 'GEN0007') {
                $.each()
                $.each(aparameter, function(key1, value1) {
                    if (value1.p_type == p_type) {
                        $("#tbodyAssessment" + parent_id + body_id + value.value_id).append(
                            '<td id="tbodyAssessment' + parent_id + body_id + value.value_id + value1.parameter_id + '"></td>'
                        )
                        $.each(avalue, function(key2, value2) {
                            if (value2.value_info == value.value_id && value2.parameter_id == value1.parameter_id && value2.p_type == p_type) {
                                console.log(value2.valie_id)
                                $("#tbodyAssessment" + parent_id + body_id + value.value_id + value1.parameter_id).append(
                                    '<div class="form-check mb-3">' +
                                    '<input name="val' + value2.value_id + '" class="form-check-input" type="checkbox" id="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' +
                                    '<label class="form-check-label" for="' + parent_id + body_id + value.value_id + value1.parameter_id + value2.value_id + '">' + value2.value_desc + '</label>' +
                                    '</div>'
                                )
                                $.each(triageDetil, function(key3, value3) {
                                    if (value3.value_id == value2.value_id) {
                                        console.log(parent_id + body_id + value.value_id + value2.parameter_id + value3.value_id)
                                        $("#" + parent_id + body_id + value.value_id + value2.parameter_id + value3.value_id).prop("checked", true)
                                    }
                                })
                            }

                        });
                    }
                });

            }
        })

    }

    function getApgar(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getApgar',
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
                apgar = data.apgar
                apgarDetil = data.apgarDetil

                $.each(apgar, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyApgarPerawat").html("")
                        addApgar(0, key, "arpbody_id", "bodyApgarPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyApgarMedis").html("")
                        addApgar(0, key, "armpasien_diagnosa_id", "bodyApgarMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addDerajatStabilitas(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = stabilitas[index].body_id
        }
        $("#" + container).append(
            '<form id="formStabilitas' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">' +
            '<div class="card border border-1 rounded-4 m-4 p-4">' +
            '<div class="card-body">' +
            '<h4 class="card-title"> Derajat Stabilitas' +
            '</h4>' +
            '<div class="row mt-4">' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-3">' +
            '<h5 class="font-size-14 mb-4 badge bg-primary">Indikator:</h5>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<select class="form-control" id="stabilitas' + bodyId + '" name="stabilitas">' +
            <?php foreach ($aValue as $key1 => $value1) {
                if ($value1['p_type'] == 'GEN0012') {
            ?> '<option value="<?= $value1['value_id']; ?>">[<?= $value1['value_score']; ?>] <?= $value1['value_desc']; ?>' +
                    '</option>' +
            <?php
                }
            } ?> '</select>' +
            '</div>' +
            '<table class="col-md-12 table table-striped">' +
            '<thead>' +
            '<tr id="headAssessment005' + bodyId + '">' +
            '<th>Level</th>' +
            '<th>Kategori</th>' +
            '<th>Pendamping Internal</th>' +
            '<th>Peralatan</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody id="bodyAssessment005' + bodyId + '">' +
            <?php
            foreach ($aValue as $key2 => $value2) {
                if ($value2['p_type'] == 'GEN0012') {
                    $stabilitasArray = explode(";", $value2['value_info']);
            ?> '<tr>' +
                    '<td><?= $value2['value_score']; ?></td>' +
                    '<td><?= $value2['value_desc']; ?></td>' +
                    '<td><?= $stabilitasArray[0]; ?></td>' +
                    '<td><?= $stabilitasArray[1]; ?></td>' +
                    '</tr>' +
            <?php
                }
            }
            ?> '</tbody>' +
            '</table>' +
            '</div>' +
            '<div class="panel-footer text-end mb-4">' +
            '<button type="submit" id="formStabilitasSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
            '<button style="margin-right: 10px" type="button" id="formStabilitasEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</form>'
        )


        $("#formStabilitasEditBtn" + bodyId).on("click", function() {
            $("#formStabilitasSaveBtn" + bodyId).show()
            $("#formStabilitasEditBtn" + bodyId).hide()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formStabilitas" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="clinic_id" id="stabilitasclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="employee_id" id="stabilitasemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="petugas_id" id="stabilitaspetugas_id' + bodyId + '" type="hidden" value="" class="form-control" />')
            .append('<input name="class_room_id" id="stabilitasclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id" id="stabilitasbed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="description" id="stabilitasdescription' + bodyId + '" type="hidden" value="<?= $visit['description']; ?>" class="form-control" />')
            .append('<input name="modified_date" id="stabilitasmodified_date' + bodyId + '" type="hidden" value="<?= $visit['modified_date']; ?>" class="form-control" />')
            .append('<input name="modified_by" id="stabilitasmodified_by' + bodyId + '" type="hidden" value="<?= $visit['modified_by']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES032" class="form-control" />')
        $("#formStabilitas" + bodyId).on('submit', (function(e) {
            $("#stabilitasdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveStabilitas',
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
                    $('#formStabilitas' + bodyId + ' select').prop("disabled", true)
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
            $("#formStabilitasSaveBtn" + bodyId).show()
            $("#formStabilitasEditBtn" + bodyId).hide()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            $("#formStabilitasSaveBtn" + bodyId).hide()
            $("#formStabilitasEditBtn" + bodyId).show()
            $("#formStabilitas" + bodyId).find("input, textarea, select").prop("disabled", true)

            $.each(stabilitasDetail, function(key, value) {
                if (value.body_id == bodyId) {
                    $('#stabilitas' + bodyId).val(value.value_id)
                    $('#stabilitas' + bodyId).prop("disabled", true)
                }

            })
        }
        index++
        $("#addDerajatStabilitasButton").html('<a onclick="addDerajatStabilitas(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getStabilitas(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getStabilitas',
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
                stabilitas = data.stabilitas
                stabilitasDetail = data.stabilitasDetail

                $.each(stabilitas, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addDerajatStabilitas(0, key, "arpbody_id", "bodyStabilitasPerawat")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addDerajatStabilitas(0, key, "armpasien_diagnosa_id", "bodyStabilitasMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        initializeSearchTarif("searchTarifPerawat", '<?= $visit['clinic_id']; ?>')
        initializeSearchTarif("searchTarifPerawatMandiri", '<?= $visit['clinic_id']; ?>')
    })
    var rowKolaborasi = 1;
    var rowMandiri = 1;
    var rowImplementasi = 1;

    function addBillChargePerawat(container, type, flag = 1, index) {

        if (flag == 1) {
            tarifDataJson = $("#" + container).val();
            tarifData = JSON.parse(tarifDataJson);

            var key = parseInt(billPerawatJson.length)
            billPerawatJson[key] = [];
        } else {
            var key = index;
            var billPerawat = billPerawatJson[index]
        }
        if (type == 1) {
            $("#chargesBodyPerawat").append($("<tr id=\"perawatBill" + key + "\">"))
        } else if (type == 2) {
            $("#chargesBodyPerawatMandiri").append($("<tr id=\"perawatBill" + key + "\">"))
        } else if (type == 3) {
            $("#chargesBodyPerawatImplementasi").append($("<tr id=\"perawatBill" + key + "\">"))
        }

        if (flag == 1) {
            if (type == 1) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowKolaborasi) + "."))
                rowKolaborasi++;
            } else if (type == 2) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowMandiri) + "."))
                rowMandiri++;
            } else if (type == 3) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowImplementasi) + "."))
                rowImplementasi++;
            }
            $("#perawatBill" + key)
                .append($("<td>").attr("id", "treatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
                .append($("<td>").attr("id", "treat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
                .append($("<td>")
                    .append('<textarea type="text" name="description[]" id="acpdescription' + key + '" placeholder="" class="form-control" >')
                )
                .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="acpquantity' + key + '" placeholder="" value="1" class="form-control" >')
                    .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                )
                .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
                .append($("<td>").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
        } else {
            if (type == 1) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowKolaborasi) + "."))
                rowKolaborasi++;
            } else if (type == 2) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowMandiri) + "."))
                rowMandiri++;
            } else if (type == 3) {
                $("#perawatBill" + key)
                    .append($("<td>").html(String(rowImplementasi) + "."))
                rowImplementasi++;
            }
            $("#perawatBill" + key)
                .append($("<td>").attr("id", "treatment" + key).html(billPerawat.treatment).append($("<p>").html('<?= $visit['fullname']; ?>')))
                .append($("<td>").attr("id", "treat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
                .append($("<td>")
                    .append('<textarea type="text" name="description[]" id="acpdescription' + key + '" placeholder="" class="form-control" >')
                )
                .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(billPerawat.amount))).append($("<p>").html("")))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="acpquantity' + key + '" placeholder="" value="1" class="form-control" >')
                    .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                )
                .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(billPerawat.amount_paid))))
                .append($("<td>").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
        }

        $("#radChargesBody")
            .append('<input name="treatment[]" id="aradtreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="aradtreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="aradsell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="aradamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="araddiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="aradsubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="aradsubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="aradbill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="aradtrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="aradno_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="aradtheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="aradvisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aradorg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="aradclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="aradpayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="aradkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="aradtheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="aradthename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="aradtheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="aradstatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isRJ[]" id="aradisRJ' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="aradgender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="aradageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="aradagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="aradageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="aradkal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="aradkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="aradclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="aradbed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="aradclinic_id' + key + '" type="hidden" value="P016" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aradclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="aradexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="aradcashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="aradmodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="aradislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="aradmeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="aradtarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')




        $("#simpanBillPerawatBtn" + key).on('click', (function(e) {
            // var inputvalue = Array();
            // $("#perawatBill" + key).find("input, textarea").each(function() {
            //     inputvalue[this.name] = this.value
            // })
            // console.log(inputvalue)
            var formElemet = document.getElementById("formchargesBodyPerawat");
            var formData = new FormData(formElemet);
            var inputvalue = {};
            var count = {};

            // Loop through form data entries
            // formData.forEach(function(value1, key1) {
            //     console.log(key1)
            //     console.log(value1)
            //     // Check if key contains square brackets
            //     if (key1.indexOf('[]') !== -1) {
            //         var name = key1.substr(0, key1.length - 2);
            //         count[name] = (count[name] || 0) + 1; // Increment count for the key

            //         // If it's the second occurrence of the key, extract its value
            //         if (count[name] === key + 1) {
            //             inputvalue[name] = value1;
            //         }
            //     }
            // });
            // console.log(inputvalue)
            // console.log(JSON.stringify(inputvalue))
            inputvalue['org_unit_code'] = $("#acporg_unit_code" + key).val()
            inputvalue['bill_id'] = $("#acpbill_id" + key).val()
            inputvalue['no_registration'] = $("#acpno_registration" + key).val()
            inputvalue['visit_id'] = $("#acpvisit_id" + key).val()
            inputvalue['tarif_id'] = $("#acptarif_id" + key).val()
            inputvalue['class_id'] = $("#acpclass_id" + key).val()
            inputvalue['clinic_id'] = $("#acpclinic_id" + key).val()
            inputvalue['clinic_id_from'] = $("#acpclinic_id_from" + key).val()
            inputvalue['treatment'] = $("#acptreatment" + key).val()
            inputvalue['treat_date'] = $("#acptreat_date" + key).val()
            inputvalue['amount'] = $("#acpamount" + key).val()
            inputvalue['quantity'] = $("#acpquantity" + key).val()
            inputvalue['measure_id'] = $("#acpmeasure_id" + key).val()
            inputvalue['pokok_jual'] = $("#acppokok_jual" + key).val()
            inputvalue['ppn'] = $("#acpppn" + key).val()
            inputvalue['margin'] = $("#acpmargin" + key).val()
            inputvalue['subsidi'] = $("#acpsubsidi" + key).val()
            inputvalue['embalace'] = $("#acpembalace" + key).val()
            inputvalue['profesi'] = $("#acpprofesi" + key).val()
            inputvalue['discount'] = $("#acpdiscount" + key).val()
            inputvalue['pay_method_id'] = $("#acppay_method_id" + key).val()
            inputvalue['payment_date'] = $("#acppayment_date" + key).val()
            inputvalue['islunas'] = $("#acpislunas" + key).val()
            inputvalue['duedate_angsuran'] = $("#acpduedate_angsuran" + key).val()
            inputvalue['description'] = $("#acpdescription" + key).val()
            inputvalue['kuitansi_id'] = $("#acpkuitansi_id" + key).val()
            inputvalue['nota_no'] = $("#acpnota_no" + key).val()
            inputvalue['iscetak'] = $("#acpiscetak" + key).val()
            inputvalue['print_date'] = $("#acpprint_date" + key).val()
            inputvalue['resep_no'] = $("#acpresep_no" + key).val()
            inputvalue['resep_ke'] = $("#acpresep_ke" + key).val()
            inputvalue['dose'] = $("#acpdose" + key).val()
            inputvalue['orig_dose'] = $("#acporig_dose" + key).val()
            inputvalue['dose_presc'] = $("#acpdose_presc" + key).val()
            inputvalue['iter'] = $("#acpiter" + key).val()
            inputvalue['iter_ke'] = $("#acpiter_ke" + key).val()
            inputvalue['sold_status'] = $("#acpsold_status" + key).val()
            inputvalue['racikan'] = $("#acpracikan" + key).val()
            inputvalue['class_room_id'] = $("#acpclass_room_id" + key).val()
            inputvalue['keluar_id'] = $("#acpkeluar_id" + key).val()
            inputvalue['bed_id'] = $("#acpbed_id" + key).val()
            inputvalue['perda_id'] = $("#acpperda_id" + key).val()
            inputvalue['employee_id'] = $("#acpemployee_id" + key).val()
            inputvalue['description2'] = $("#acpdescription2" + key).val()
            inputvalue['modified_by'] = $("#acpmodified_by" + key).val()
            inputvalue['modified_date'] = $("#acpmodified_date" + key).val()
            inputvalue['modified_from'] = $("#acpmodified_from" + key).val()
            inputvalue['brand_id'] = $("#acpbrand_id" + key).val()
            inputvalue['doctor'] = $("#acpdoctor" + key).val()
            inputvalue['jml_bks'] = $("#acpjml_bks" + key).val()
            inputvalue['exit_date'] = $("#acpexit_date" + key).val()
            inputvalue['fa_v'] = $("#acpfa_v" + key).val()
            inputvalue['task_id'] = $("#acptask_id" + key).val()
            inputvalue['employee_id_from'] = $("#acpemployee_id_from" + key).val()
            inputvalue['doctor_from'] = $("#acpdoctor_from" + key).val()
            inputvalue['status_pasien_id'] = $("#acpstatus_pasien_id" + key).val()
            inputvalue['amount_paid'] = $("#acpamount_paid" + key).val()
            inputvalue['thename'] = $("#acpthename" + key).val()
            inputvalue['theaddress'] = $("#acptheaddress" + key).val()
            inputvalue['theid'] = $("#acptheid" + key).val()
            inputvalue['serial_nb'] = $("#acpserial_nb" + key).val()
            inputvalue['treatment_plafond'] = $("#acptreatment_plafond" + key).val()
            inputvalue['amount_plafond'] = $("#acpamount_plafond" + key).val()
            inputvalue['amount_paid_plafond'] = $("#acpamount_paid_plafond" + key).val()
            inputvalue['class_id_plafond'] = $("#acpclass_id_plafond" + key).val()
            inputvalue['payor_id'] = $("#acppayor_id" + key).val()
            inputvalue['pembulatan'] = $("#acppembulatan" + key).val()
            inputvalue['isrj'] = $("#acpisrj" + key).val()
            inputvalue['ageyear'] = $("#acpageyear" + key).val()
            inputvalue['agemonth'] = $("#acpagemonth" + key).val()
            inputvalue['ageday'] = $("#acpageday" + key).val()
            inputvalue['gender'] = $("#acpgender" + key).val()
            inputvalue['kal_id'] = $("#acpkal_id" + key).val()
            inputvalue['correction_id'] = $("#acpcorrection_id" + key).val()
            inputvalue['correction_by'] = $("#acpcorrection_by" + key).val()
            inputvalue['karyawan'] = $("#acpkaryawan" + key).val()
            inputvalue['account_id'] = $("#acpaccount_id" + key).val()
            inputvalue['sell_price'] = $("#acpsell_price" + key).val()
            inputvalue['diskon'] = $("#acpdiskon" + key).val()
            inputvalue['invoice_id'] = $("#acpinvoice_id" + key).val()
            inputvalue['numer'] = $("#acpnumer" + key).val()
            inputvalue['measure_id2'] = $("#acpmeasure_id2" + key).val()
            inputvalue['potongan'] = $("#acppotongan" + key).val()
            inputvalue['bayar'] = $("#acpbayar" + key).val()
            inputvalue['retur'] = $("#acpretur" + key).val()
            inputvalue['tarif_type'] = $("#acptarif_type" + key).val()
            inputvalue['ppnvalue'] = $("#acpppnvalue" + key).val()
            inputvalue['tagihan'] = $("#acptagihan" + key).val()
            inputvalue['koreksi'] = $("#acpkoreksi" + key).val()
            inputvalue['status_obat'] = $("#acpstatus_obat" + key).val()
            inputvalue['subsidisat'] = $("#acpsubsidisat" + key).val()
            inputvalue['printq'] = $("#acpprintq" + key).val()
            inputvalue['printed_by'] = $("#acpprinted_by" + key).val()
            inputvalue['stock_available'] = $("#acpstock_available" + key).val()
            inputvalue['status_tarif'] = $("#acpstatus_tarif" + key).val()
            inputvalue['clinic_type'] = $("#acpclinic_type" + key).val()
            inputvalue['package_id'] = $("#acppackage_id" + key).val()
            inputvalue['module_id'] = $("#acpmodule_id" + key).val()
            inputvalue['profession'] = $("#acpprofession" + key).val()
            inputvalue['theorder'] = $("#acptheorder" + key).val()
            inputvalue['cashier'] = $("#acpcashier" + key).val()
            inputvalue['trans_id'] = $("#acptrans_id" + key).val()
            inputvalue['nosep'] = $("#acpnosep" + key).val()
            inputvalue['pasien_id'] = $("#acppasien_id" + key).val()
            inputvalue['total_tagihan'] = $("#acptotal_tagihan" + key).val()
            inputvalue['tarif_id_plafond'] = $("#acptarif_id_plafond" + key).val()
            inputvalue['treatment_type'] = $("#acptreatment_type" + key).val()

            // console.log(inputvalue)

            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/addBillCharge',
                type: "POST",
                data: JSON.stringify(inputvalue),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    $("#simpanBillPerawatBtn" + key).hide()
                    $("#editDeleteBillPerawat" + key).show()

                    $("#perawatBill" + key).find("input, textarea").prop("disabled", true)
                    $("#acpbill_id" + key).val(data.billId)

                },
                error: function() {

                }
            });
        }))

        $("#editBillBtn" + key).on("click", function(e) {
            $("#perawatBill" + key).find("input, textarea").prop("disabled", false)
            $("#simpanBillPerawatBtn" + key).show()
            $("#editDeleteBillPerawat" + key).hide()
        })

        $("#perawatBill" + key)
            .append('<input id="acporg_unit_code' + key + '" type="hidden" name="org_unit_code[]">')
            .append('<input id="acpbill_id' + key + '" type="hidden" name="bill_id[]">')
            .append('<input id="acpno_registration' + key + '" type="hidden" name="no_registration[]">')
            .append('<input id="acpvisit_id' + key + '" type="hidden" name="visit_id[]">')
            .append('<input id="acptarif_id' + key + '" type="hidden" name="tarif_id[]">')
            .append('<input id="acpclass_id' + key + '" type="hidden" name="class_id[]">')
            .append('<input id="acpclinic_id' + key + '" type="hidden" name="clinic_id[]">')
            .append('<input id="acpclinic_id_from' + key + '" type="hidden" name="clinic_id_from[]">')
            .append('<input id="acptreatment' + key + '" type="hidden" name="treatment[]">')
            .append('<input id="acptreat_date' + key + '" type="hidden" name="treat_date[]">')
            .append('<input id="acpamount' + key + '" type="hidden" name="amount[]">')
            .append('<input id="acpmeasure_id' + key + '" type="hidden" name="measure_id[]">')
            .append('<input id="acppokok_jual' + key + '" type="hidden" name="pokok_jual[]">')
            .append('<input id="acpppn' + key + '" type="hidden" name="ppn[]">')
            .append('<input id="acpmargin' + key + '" type="hidden" name="margin[]">')
            .append('<input id="acpsubsidi' + key + '" type="hidden" name="subsidi[]">')
            .append('<input id="acpembalace' + key + '" type="hidden" name="embalace[]">')
            .append('<input id="acpprofesi' + key + '" type="hidden" name="profesi[]">')
            .append('<input id="acpdiscount' + key + '" type="hidden" name="discount[]">')
            .append('<input id="acppay_method_id' + key + '" type="hidden" name="pay_method_id[]">')
            .append('<input id="acppayment_date' + key + '" type="hidden" name="payment_date[]">')
            .append('<input id="acpislunas' + key + '" type="hidden" name="islunas[]">')
            .append('<input id="acpduedate_angsuran' + key + '" type="hidden" name="duedate_angsuran[]">')
            .append('<input id="acpkuitansi_id' + key + '" type="hidden" name="kuitansi_id[]">')
            .append('<input id="acpnota_no' + key + '" type="hidden" name="nota_no[]">')
            .append('<input id="acpiscetak' + key + '" type="hidden" name="iscetak[]">')
            .append('<input id="acpprint_date' + key + '" type="hidden" name="print_date[]">')
            .append('<input id="acpresep_no' + key + '" type="hidden" name="resep_no[]">')
            .append('<input id="acpresep_ke' + key + '" type="hidden" name="resep_ke[]">')
            .append('<input id="acpdose' + key + '" type="hidden" name="dose[]">')
            .append('<input id="acporig_dose' + key + '" type="hidden" name="orig_dose[]">')
            .append('<input id="acpdose_presc' + key + '" type="hidden" name="dose_presc[]">')
            .append('<input id="acpiter' + key + '" type="hidden" name="iter[]">')
            .append('<input id="acpiter_ke' + key + '" type="hidden" name="iter_ke[]">')
            .append('<input id="acpsold_status' + key + '" type="hidden" name="sold_status[]">')
            .append('<input id="acpracikan' + key + '" type="hidden" name="racikan[]">')
            .append('<input id="acpclass_room_id' + key + '" type="hidden" name="class_room_id[]">')
            .append('<input id="acpkeluar_id' + key + '" type="hidden" name="keluar_id[]">')
            .append('<input id="acpbed_id' + key + '" type="hidden" name="bed_id[]">')
            .append('<input id="acpperda_id' + key + '" type="hidden" name="perda_id[]">')
            .append('<input id="acpemployee_id' + key + '" type="hidden" name="employee_id[]">')
            .append('<input id="acpdescription2' + key + '" type="hidden" name="description2[]">')
            .append('<input id="acpmodified_by' + key + '" type="hidden" name="modified_by[]">')
            .append('<input id="acpmodified_date' + key + '" type="hidden" name="modified_date[]">')
            .append('<input id="acpmodified_from' + key + '" type="hidden" name="modified_from[]">')
            .append('<input id="acpbrand_id' + key + '" type="hidden" name="brand_id[]">')
            .append('<input id="acpdoctor' + key + '" type="hidden" name="doctor[]">')
            .append('<input id="acpjml_bks' + key + '" type="hidden" name="jml_bks[]">')
            .append('<input id="acpexit_date' + key + '" type="hidden" name="exit_date[]">')
            .append('<input id="acpfa_v' + key + '" type="hidden" name="fa_v[]">')
            .append('<input id="acptask_id' + key + '" type="hidden" name="task_id[]">')
            .append('<input id="acpemployee_id_from' + key + '" type="hidden" name="employee_id_from[]">')
            .append('<input id="acpdoctor_from' + key + '" type="hidden" name="doctor_from[]">')
            .append('<input id="acpstatus_pasien_id' + key + '" type="hidden" name="status_pasien_id[]">')
            .append('<input id="acpamount_paid' + key + '" type="hidden" name="amount_paid[]">')
            .append('<input id="acpthename' + key + '" type="hidden" name="thename[]">')
            .append('<input id="acptheaddress' + key + '" type="hidden" name="theaddress[]">')
            .append('<input id="acptheid' + key + '" type="hidden" name="theid[]">')
            .append('<input id="acpserial_nb' + key + '" type="hidden" name="serial_nb[]">')
            .append('<input id="acptreatment_plafond' + key + '" type="hidden" name="treatment_plafond[]">')
            .append('<input id="acpamount_plafond' + key + '" type="hidden" name="amount_plafond[]">')
            .append('<input id="acpamount_paid_plafond' + key + '" type="hidden" name="amount_paid_plafond[]">')
            .append('<input id="acpclass_id_plafond' + key + '" type="hidden" name="class_id_plafond[]">')
            .append('<input id="acppayor_id' + key + '" type="hidden" name="payor_id[]">')
            .append('<input id="acppembulatan' + key + '" type="hidden" name="pembulatan[]">')
            .append('<input id="acpisrj' + key + '" type="hidden" name="isrj[]">')
            .append('<input id="acpageyear' + key + '" type="hidden" name="ageyear[]">')
            .append('<input id="acpagemonth' + key + '" type="hidden" name="agemonth[]">')
            .append('<input id="acpageday' + key + '" type="hidden" name="ageday[]">')
            .append('<input id="acpgender' + key + '" type="hidden" name="gender[]">')
            .append('<input id="acpkal_id' + key + '" type="hidden" name="kal_id[]">')
            .append('<input id="acpcorrection_id' + key + '" type="hidden" name="correction_id[]">')
            .append('<input id="acpcorrection_by' + key + '" type="hidden" name="correction_by[]">')
            .append('<input id="acpkaryawan' + key + '" type="hidden" name="karyawan[]">')
            .append('<input id="acpaccount_id' + key + '" type="hidden" name="account_id[]">')
            .append('<input id="acpsell_price' + key + '" type="hidden" name="sell_price[]">')
            .append('<input id="acpdiskon' + key + '" type="hidden" name="diskon[]">')
            .append('<input id="acpinvoice_id' + key + '" type="hidden" name="invoice_id[]">')
            .append('<input id="acpnumer' + key + '" type="hidden" name="numer[]">')
            .append('<input id="acpmeasure_id2' + key + '" type="hidden" name="measure_id2[]">')
            .append('<input id="acppotongan' + key + '" type="hidden" name="potongan[]">')
            .append('<input id="acpbayar' + key + '" type="hidden" name="bayar[]">')
            .append('<input id="acpretur' + key + '" type="hidden" name="retur[]">')
            .append('<input id="acptarif_type' + key + '" type="hidden" name="tarif_type[]">')
            .append('<input id="acpppnvalue' + key + '" type="hidden" name="ppnvalue[]">')
            .append('<input id="acptagihan' + key + '" type="hidden" name="tagihan[]">')
            .append('<input id="acpkoreksi' + key + '" type="hidden" name="koreksi[]">')
            .append('<input id="acpstatus_obat' + key + '" type="hidden" name="status_obat[]">')
            .append('<input id="acpsubsidisat' + key + '" type="hidden" name="subsidisat[]">')
            .append('<input id="acpprintq' + key + '" type="hidden" name="printq[]">')
            .append('<input id="acpprinted_by' + key + '" type="hidden" name="printed_by[]">')
            .append('<input id="acpstock_available' + key + '" type="hidden" name="stock_available[]">')
            .append('<input id="acpstatus_tarif' + key + '" type="hidden" name="status_tarif[]">')
            .append('<input id="acpclinic_type' + key + '" type="hidden" name="clinic_type[]">')
            .append('<input id="acppackage_id' + key + '" type="hidden" name="package_id[]">')
            .append('<input id="acpmodule_id' + key + '" type="hidden" name="module_id[]">')
            .append('<input id="acpprofession' + key + '" type="hidden" name="profession[]">')
            .append('<input id="acptheorder' + key + '" type="hidden" name="theorder[]">')
            .append('<input id="acpcashier' + key + '" type="hidden" name="cashier[]">')
            .append('<input id="acptrans_id' + key + '" type="hidden" name="trans_id[]">')
            .append('<input id="acpnosep' + key + '" type="hidden" name="nosep[]">')
            .append('<input id="acppasien_id' + key + '" type="hidden" name="pasien_id[]">')
            .append('<input id="acptotal_tagihan' + key + '" type="hidden" name="total_tagihan[]">')
            .append('<input id="acptarif_id_plafond' + key + '" type="hidden" name="tarif_id_plafond[]">')
            .append('<input id="acptreatment_type' + key + '" type="hidden" name="treatment_type[]">')


        if (flag == 1) {
            $("#acptreatment" + key).val(tarifData.tarif_name)
            $("#acptreat_date" + key).val(get_date())
            $("#acpsell_price" + key).val(tarifData.amount)
            $("#acpamount_paid" + key).val(tarifData.amount)
            $("#acpdiscount" + key).val(0)
            $("#acpsubsidisat" + key).val(0)
            $("#acpsubsidi" + key).val(0)
            $("#acpexit_date" + key).val(get_date())
            $("#acpcashier" + key).val('<?= user_id(); ?>')
            $("#acptarif_id" + key).val(tarifData.tarif_id)
            $("#acptrans_id" + key).val('<?= $visit['trans_id']; ?>')
            $("#acpno_registration" + key).val('<?= $visit['no_registration']; ?>')
            $("#acpvisit_id" + key).val('<?= $visit['visit_id']; ?>')
            $("#acporg_unit_code" + key).val('<?= $visit['org_unit_code']; ?>')
            $("#acpclass_id" + key).val('<?= $visit['class_id']; ?>')
            $("#acpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
            $("#acppayor_id" + key).val('<?= $visit['payor_id']; ?>')
            $("#acpkaryawan" + key).val('<?= $visit['karyawan']; ?>')
            $("#acppasien_id" + key).val('<?= $visit['pasien_id']; ?>')
            $("#acpdiantar_oleh" + key).val('<?= $visit['diantar_oleh']; ?>')
            $("#acpvisitor_address" + key).val('<?= $visit['visitor_address']; ?>')
            $("#acpstatus_pasien_id" + key).val('<?= $visit['status_pasien_id']; ?>')
            $("#acpisrj" + key).val('<?= $visit['isrj']; ?>')
            $("#acpgender" + key).val('<?= $visit['gender']; ?>')
            $("#acpageyear" + key).val('<?= $visit['ageyear']; ?>')
            $("#acpagemonth" + key).val('<?= $visit['agemonth']; ?>')
            $("#acpageday" + key).val('<?= $visit['ageday']; ?>')
            $("#acpkal_id" + key).val('<?= $visit['kal_id']; ?>')
            $("#acpkaryawan" + key).val('<?= $visit['karyawan']; ?>')
            $("#acpclass_room_id" + key).val('<?= $visit['class_room_id']; ?>')
            $("#acpbed_id" + key).val('<?= $visit['bed_id']; ?>')
            $("#acpclinic_id" + key).val('<?= $visit['clinic_id']; ?>')
            $("#acpclinic_id_from" + key).val('<?= $visit['clinic_id_from']; ?>')
            $("#acpclinic_id" + key).val('<?= $visit['clinic_id']; ?>')
            $("#acptreatment_type" + key).val(type)
            if ('<?= $visit['isrj']; ?>' == '0') {
                $("#acpclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
                $("#acpbed_id" + key).val('<?= $visit['bed_id']; ?>');
                <?php
                if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                ?>
                    $("#acpemployee_id_from" + key).val('<?= $visit['employee_id_from']; ?>')
                    $("#acpdoctor_from" + key).val('<?= $visit['fullname_from']; ?>')
                <?php
                } else {
                ?>
                    $("#acpemployee_id_from" + key).val('<?= $visit['employee_inap']; ?>')
                    $("#acpdoctor_from" + key).val('<?= $visit['fullname_inap']; ?>')
                <?php
                }
                ?>
            } else {
                <?php
                if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                ?>
                    $("#acpemployee_id_from" + key).val('<?= $visit['employee_id_from']; ?>')
                    $("#acpdoctor_from" + key).val('<?= $visit['fullname_from']; ?>')
                <?php
                } else {
                ?>
                    $("#acpemployee_id_from" + key).val('<?= $visit['employee_id']; ?>')
                    $("#acpdoctor_from" + key).val('<?= $visit['fullname']; ?>')
                <?php
                }
                ?>
            }
            $("#acpemployee_id" + key).val('<?= $visit['employee_id']; ?>')
            $("#acpdoctor" + key).val('<?= $visit['fullname']; ?>')
            $("#acpamount" + key).val(tarifData.amount)
            $("#acpnota_no" + key).val(null)
            $("#acpprofesi" + key).val(null)
            $("#acptagihan" + key).val(tarifData.amount * $("#acpquantity" + key).val())
            $("#acptreatment_plafond" + key).val(tarifData.amount)
            $("#acptarif_type" + key).val(tarifData.tarif_type)
            if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
                var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
                if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {

                    $("#acpamount_plafond").val(tarifKelas)
                    $("#acpamount_paid_plafond").val(tarifKelas)
                    $("#acpclass_id_plafond").val('<?= $visit['class_id_plafond']; ?>')
                    $("#acptarif_id_plafond").val(tarifData.tarif_id)
                } else {
                    $("#acpamount_plafond" + key).val(0)
                    $("#acpamount_paid_plafond" + key).val(0)
                    $("#acpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
                    $("#acptarif_id_plafond" + key).val()
                }
            } else {
                $("#acpamount_plafond" + key).val(0)
                $("#acpamount_paid_plafond" + key).val(0)
                $("#acpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
                $("#acptarif_id_plafond" + key).val()
            }

            $("#acpquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
            });
            $('#acpquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#acpamount_paid" + key).val($("#acpamount" + key).val() * dInput)
                $("#displayamount_paid" + key).html(formatCurrency($("#acpamount" + key).val() * dInput))
                $("#atagihan" + key).val($("#acpamount" + key).val() * dInput)
                $("#acpamount_paid_plafond" + key).val($("#acpamount_plafond" + key).val() * dInput)
                $("#displayamount_paid_plafond" + key).html(formatCurrency($("#acpamount_plafond" + key).val() * dInput))
            })
        } else {
            $("#acporg_unit_code" + key).val(billPerawat.org_unit_code)
            $("#acpbill_id" + key).val(billPerawat.bill_id)
            $("#acpno_registration" + key).val(billPerawat.no_registration)
            $("#acpvisit_id" + key).val(billPerawat.visit_id)
            $("#acptarif_id" + key).val(billPerawat.tarif_id)
            $("#acpclass_id" + key).val(billPerawat.class_id)
            $("#acpclinic_id" + key).val(billPerawat.clinic_id)
            $("#acpclinic_id_from" + key).val(billPerawat.clinic_id_from)
            $("#acptreatment" + key).val(billPerawat.treatment)
            $("#acptreat_date" + key).val(billPerawat.treat_date)
            $("#acpamount" + key).val(billPerawat.amount)
            $("#acpquantity" + key).val(billPerawat.quantity)
            $("#acpmeasure_id" + key).val(billPerawat.measure_id)
            $("#acppokok_jual" + key).val(billPerawat.pokok_jual)
            $("#acpppn" + key).val(billPerawat.ppn)
            $("#acpmargin" + key).val(billPerawat.margin)
            $("#acpsubsidi" + key).val(billPerawat.subsidi)
            $("#acpembalace" + key).val(billPerawat.embalace)
            $("#acpprofesi" + key).val(billPerawat.profesi)
            $("#acpdiscount" + key).val(billPerawat.discount)
            $("#acppay_method_id" + key).val(billPerawat.pay_method_id)
            $("#acppayment_date" + key).val(billPerawat.payment_date)
            $("#acpislunas" + key).val(billPerawat.islunas)
            $("#acpduedate_angsuran" + key).val(billPerawat.duedate_angsuran)
            $("#acpdescription" + key).val(billPerawat.description)
            $("#acpkuitansi_id" + key).val(billPerawat.kuitansi_id)
            $("#acpnota_no" + key).val(billPerawat.nota_no)
            $("#acpiscetak" + key).val(billPerawat.iscetak)
            $("#acpprint_date" + key).val(billPerawat.print_date)
            $("#acpresep_no" + key).val(billPerawat.resep_no)
            $("#acpresep_ke" + key).val(billPerawat.resep_ke)
            $("#acpdose" + key).val(billPerawat.dose)
            $("#acporig_dose" + key).val(billPerawat.orig_dose)
            $("#acpdose_presc" + key).val(billPerawat.dose_presc)
            $("#acpiter" + key).val(billPerawat.iter)
            $("#acpiter_ke" + key).val(billPerawat.iter_ke)
            $("#acpsold_status" + key).val(billPerawat.sold_status)
            $("#acpracikan" + key).val(billPerawat.racikan)
            $("#acpclass_room_id" + key).val(billPerawat.class_room_id)
            $("#acpkeluar_id" + key).val(billPerawat.keluar_id)
            $("#acpbed_id" + key).val(billPerawat.bed_id)
            $("#acpperda_id" + key).val(billPerawat.perda_id)
            $("#acpemployee_id" + key).val(billPerawat.employee_id)
            $("#acpdescription2" + key).val(billPerawat.description2)
            $("#acpmodified_by" + key).val(billPerawat.modified_by)
            $("#acpmodified_date" + key).val(billPerawat.modified_date)
            $("#acpmodified_from" + key).val(billPerawat.modified_from)
            $("#acpbrand_id" + key).val(billPerawat.brand_id)
            $("#acpdoctor" + key).val(billPerawat.doctor)
            $("#acpjml_bks" + key).val(billPerawat.jml_bks)
            $("#acpexit_date" + key).val(billPerawat.exit_date)
            $("#acpfa_v" + key).val(billPerawat.fa_v)
            $("#acptask_id" + key).val(billPerawat.task_id)
            $("#acpemployee_id_from" + key).val(billPerawat.employee_id_from)
            $("#acpdoctor_from" + key).val(billPerawat.doctor_from)
            $("#acpstatus_pasien_id" + key).val(billPerawat.status_pasien_id)
            $("#acpamount_paid" + key).val(billPerawat.amount_paid)
            $("#acpthename" + key).val(billPerawat.thename)
            $("#acptheaddress" + key).val(billPerawat.theaddress)
            $("#acptheid" + key).val(billPerawat.theid)
            $("#acpserial_nb" + key).val(billPerawat.serial_nb)
            $("#acptreatment_plafond" + key).val(billPerawat.treatment_plafond)
            $("#acpamount_plafond" + key).val(billPerawat.amount_plafond)
            $("#acpamount_paid_plafond" + key).val(billPerawat.amount_paid_plafond)
            $("#acpclass_id_plafond" + key).val(billPerawat.class_id_plafond)
            $("#acppayor_id" + key).val(billPerawat.payor_id)
            $("#acppembulatan" + key).val(billPerawat.pembulatan)
            $("#acpisrj" + key).val(billPerawat.isrj)
            $("#acpageyear" + key).val(billPerawat.ageyear)
            $("#acpagemonth" + key).val(billPerawat.agemonth)
            $("#acpageday" + key).val(billPerawat.ageday)
            $("#acpgender" + key).val(billPerawat.gender)
            $("#acpkal_id" + key).val(billPerawat.kal_id)
            $("#acpcorrection_id" + key).val(billPerawat.correction_id)
            $("#acpcorrection_by" + key).val(billPerawat.correction_by)
            $("#acpkaryawan" + key).val(billPerawat.karyawan)
            $("#acpaccount_id" + key).val(billPerawat.account_id)
            $("#acpsell_price" + key).val(billPerawat.sell_price)
            $("#acpdiskon" + key).val(billPerawat.diskon)
            $("#acpinvoice_id" + key).val(billPerawat.invoice_id)
            $("#acpnumer" + key).val(billPerawat.numer)
            $("#acpmeasure_id2" + key).val(billPerawat.measure_id2)
            $("#acppotongan" + key).val(billPerawat.potongan)
            $("#acpbayar" + key).val(billPerawat.bayar)
            $("#acpretur" + key).val(billPerawat.retur)
            $("#acptarif_type" + key).val(billPerawat.tarif_type)
            $("#acpppnvalue" + key).val(billPerawat.ppnvalue)
            $("#acptagihan" + key).val(billPerawat.tagihan)
            $("#acpkoreksi" + key).val(billPerawat.koreksi)
            $("#acpstatus_obat" + key).val(billPerawat.status_obat)
            $("#acpsubsidisat" + key).val(billPerawat.subsidisat)
            $("#acpprintq" + key).val(billPerawat.printq)
            $("#acpprinted_by" + key).val(billPerawat.printed_by)
            $("#acpstock_available" + key).val(billPerawat.stock_available)
            $("#acpstatus_tarif" + key).val(billPerawat.status_tarif)
            $("#acpclinic_type" + key).val(billPerawat.clinic_type)
            $("#acppackage_id" + key).val(billPerawat.package_id)
            $("#acpmodule_id" + key).val(billPerawat.module_id)
            $("#acpprofession" + key).val(billPerawat.profession)
            $("#acptheorder" + key).val(billPerawat.theorder)
            $("#acpcashier" + key).val(billPerawat.cashier)
            $("#acptrans_id" + key).val(billPerawat.trans_id)
            $("#acpnosep" + key).val(billPerawat.nosep)
            $("#acppasien_id" + key).val(billPerawat.pasien_id)
            $("#acptotal_tagihan" + key).val(billPerawat.total_tagihan)
            $("#acptarif_id_plafond" + key).val(billPerawat.tarif_id_plafond)
            $("#acptreatment_type" + key).val(billPerawat.treatment_type)

            $("#perawatBill" + key).find("input, textarea").prop("disabled", true)
            $("#simpanBillPerawatBtn" + key).hide()
            $("#editDeleteBillPerawat" + key).show()
            $("#acpquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
            });
            $('#acpquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#acpamount_paid" + key).val($("#acpamount" + key).val() * dInput)
                $("#displayamount_paid" + key).html(formatCurrency($("#acpamount" + key).val() * dInput))
                $("#atagihan" + key).val($("#acpamount" + key).val() * dInput)
                $("#acpamount_paid_plafond" + key).val($("#acpamount_plafond" + key).val() * dInput)
                $("#displayamount_paid_plafond" + key).html(formatCurrency($("#acpamount_plafond" + key).val() * dInput))
            })
        }


    }

    function getTindakanPerawat() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getTindakanPerawat',
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
                billPerawatJson = data
                $("#chargesBodyPerawat").html("")
                $("#chargesBodyPerawatMandiri").html("")
                $.each(billPerawatJson, function(key, value) {
                    addBillChargePerawat('', value.treatment_type, 0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addPernapasan(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = fallRisk[index].body_id
        }
        $("#" + container).append(
            $('<form id="formPernapasan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Pernapasan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES041') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES041' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPernapasanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPernapasanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        $("#formPernapasanEditBtn" + bodyId).on("click", function() {
            $("#formPernapasanSaveBtn" + bodyId).show()
            $("#formPernapasanEditBtn" + bodyId).hide()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        $("#ASES04105" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES041' && $value1['value_score'] == '99') {
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

        $("#formPernapasan" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES041" class="form-control" />')
        $("#formPernapasan" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePernapasan',
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
                    $('#formPernapasan' + bodyId + ' select').prop("disabled", true)
                    $('#formPernapasan' + bodyId + ' input').prop("disabled", true)
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

        $("#ASES04105" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04108" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04114" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        if (flag == 1) {
            $("#formPernapasanSaveBtn" + bodyId).show()
            $("#formPernapasanEditBtn" + bodyId).hide()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var napas = fallRisk[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES041') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(napas.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (napas.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES041' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(napas.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formPernapasanSaveBtn" + bodyId).hide()
            $("#formPernapasanEditBtn" + bodyId).show()
            $("#formPernapasan" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addPernapasanButton").html('<a onclick="addPernapasan(1,' + index + ',\'armpasien_diagnosa_id\', \'bodyPernapasanMedis\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPernapasan(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPernapasan',
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
                fallRisk = data.napas
                // stabilitasDetail = data.stabilitasDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPernapasan(0, key, "arpbody_id", "bodyPernapasan")
                    else if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addPernapasan(0, key, "armpasien_diagnosa_id", "bodyPernapasanMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addFallRisk(flag, index, document_id, container, isaddbutton = true) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = fallRisk[index].body_id
        }

        var fallRiskContent = `
        <form id="formFallRisk` + bodyId + `" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
            <div class="card border border-1 rounder-4 m-4 p-4">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Tanggal:</h5>
                            </div>
                            <div class="col-md-9">
                                <input id="examination_date` + bodyId + `" name="examination_date" type="datetime-local" class="form-control" value="2024-05-31 14:15">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Alat Ukur:</h5>
                            </div>
                            <div class="col-md-9">
                                <?php foreach ($aType as $key1 => $value1) { ?>
                                    <?php if ($value1['parent_id'] == '001') {
                                    ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="parameter<?= $value1['parent_id']; ?>" id="atype<?= $value1['p_type']; ?>` + bodyId + `" value="<?= $value1['p_type']; ?>" onchange="aValueParamFallRisk('<?= $value1['parent_id']; ?>', '<?= $value1['p_type']; ?>', '` + bodyId + `', '` + container + `')">
                                            <label class="form-check-label" for="atype<?= $value1['p_type']; ?>` + bodyId + `">
                                                <?= $value1['p_description']; ?>
                                            </label>
                                        </div>
                                    <?php
                                    } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Parameter 2:</h5>
                            </div>
                            <table class="col-md-12 table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Deskripsi</th>
                                        <th>Pilihan</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody id="` + container + `` + bodyId + `">
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formFallRiskSaveBtn` + bodyId + `" name="save" data-loading-text="processing" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button style="margin-right: 10px; ; display: none;" type="button" id="formFallRiskEditBtn` + bodyId + `" onclick="" name="save" data-loading-text="processing" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        `

        $("#" + container).append(fallRiskContent)


        $("#formFallRiskEditBtn" + bodyId).on("click", function() {
            $("#formFallRiskSaveBtn" + bodyId).show()
            $("#formFallRiskEditBtn" + bodyId).hide()
            $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        $("#formFallRisk" + bodyId).append('<input name="org_unit_code" id="fallriskorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="fallriskvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="fallrisktrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="fallriskbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="fallriskdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="fallriskno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="examination_date" id="fallriskexamination_date' + bodyId + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="clinic_id" id="fallriskclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="employee_id" id="fallriskemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="p_type" id="fallriskp_type' + bodyId + '" type="hidden" value="ASES041" class="form-control" />')
            .append('<input name="modified_by" id="fallriskmodified_by' + bodyId + '" type="hidden" value="<?= user()->username; ?>" class="form-control" />')
        $("#formFallRisk" + bodyId).on('submit', (function(e) {
            $("#fallriskdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveFallRisk',
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
                    $('#formFallRisk' + bodyId + ' select').prop("disabled", true)
                    $('#formFallRisk' + bodyId + ' input').prop("disabled", true)
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
            $("#formFallRiskSaveBtn" + bodyId).show()
            $("#formFallRiskEditBtn" + bodyId).hide()
            $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var fallselect = fallRisk[index];

            $.each(atype, function(key, value) {
                if (value.parent_id == '001') {
                    console.log("#atype" + fallselect.p_type + bodyId)
                    $("#atype" + fallselect.p_type + bodyId).prop("checked", true)
                }
            })


            aValueParamFallRisk('001', fallselect.p_type, bodyId, container)

            $.each(fallRiskDetail, function(key, value) {
                if (value.body_id == fallselect.body_id) {
                    console.log("#parent_id001" + value.value_id + value.body_id)
                    $("#parent_id001" + value.value_id + value.body_id).prop("checked", true)
                    aValueParamScore('001', value.p_type, value.parameter_id, value.value_score, bodyId)
                }
            })

            $("#formFallRiskSaveBtn" + bodyId).hide()
            $("#formFallRiskEditBtn" + bodyId).show()
            $("#formFallRisk" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++

        if (isaddbutton)
            $("#addFallRiskButton").html('<a onclick="addFallRisk(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function aValueParamFallRisk(parent_id, p_type, bodyId, container) {
        $("#" + container + bodyId).html("")
        var counter = 0;
        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                counter++;
                $("#" + container + bodyId).append(
                    '<tr>' +
                    '<td>' + counter + '.</td>' +
                    '<td> <h6 class="font-size-14 mb-4">' + value.parameter_desc + ':</h6></td>' +
                    '<td id="' + parent_id + value.p_type + value.parameter_id + bodyId + '">' +
                    '</td>' +
                    '<td><h6 id="score' + parent_id + value.p_type + value.parameter_id + bodyId + '" class="font-size-14 mb-4"></h6></td>' +
                    '</tr>'
                )
                aValueParamScore('001', 'ASES020', '01', 3)
                $.each(avalue, function(key1, value1) {
                    if (value1.parameter_id == value.parameter_id && value1.p_type == p_type) {
                        $("#" + parent_id + value.p_type + value.parameter_id + bodyId).append(
                            '<div class="form-check mb-3"><input class="form-check-input" type="radio" name="parameter_id' + value1.parameter_id + '" id="parent_id' + parent_id + value1.value_id + bodyId + '" value="' + value1.value_id + '" onchange="aValueParamScore(\'' + parent_id + '\', \'' + p_type + '\', \'' + value1.parameter_id + '\', ' + value1.value_score + ', \'' + bodyId + '\')"><label class="form-check-label" for="parent_id' + parent_id + value1.value_id + bodyId + '">' + value1.value_desc + '</label></div>'
                        )
                    }
                });
            }
        });
        $("#" + container + bodyId).append(
            '<tr><td colspan="3"><h6 class="font-size-14 mb-4">Total Score</h6></td><td><h6 id="totalScore' + parent_id + p_type + bodyId + '" class="font-size-14 mb-4"></h6></td></tr>'
        )
    }

    function aValueParamScore(parent_id, p_type, parameter_id, score, bodyId) {
        // console.log('#score' + parent_id + p_type + parameter_id + bodyId)
        // console.log(score)
        fallRiskScore['parameter_id' + parameter_id] = score;

        $('#score' + parent_id + p_type + parameter_id + bodyId).html(score)

        var total = 0;

        $.each(aparameter, function(key, value) {
            if (value.p_type == p_type) {
                var valuenya = parseInt($("#score" + parent_id + value.p_type + value.parameter_id + bodyId).html())
                console.log(valuenya)
                total += valuenya
            }
        });


        // for (var key in fallRiskScore) {
        //     total += fallRiskScore[key]
        // }
        $("#totalScore" + parent_id + p_type + bodyId).html(total)
    }

    function getFallRisk(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getFallRisk',
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
                fallRisk = data.fallRisk
                fallRiskDetail = data.fallRiskDetail

                $.each(fallRisk, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyFallRiskPerawat").html("")
                        addFallRisk(0, key, "arpbody_id", "bodyFallRiskPerawat")
                    } else if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyFallRiskMedis").html("")
                        addFallRisk(0, key, "armpasien_diagnosa_id", "bodyFallRiskMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addSirkulasi(flag, index, document_id, container) {
        var bodyId = '';
        var documentId = $("#" + document_id).val()
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = sirkulasiAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formSirkulasi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Sirkulasi"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES039') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES039' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSirkulasiSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSirkulasiEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES039' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formSirkulasiEditBtn" + bodyId).on("click", function() {
            $("#formSirkulasiSaveBtn" + bodyId).show()
            $("#formSirkulasiEditBtn" + bodyId).hide()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#ASES03901" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES03906" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });


        $("#formSirkulasi" + bodyId).append('<input name="org_unit_code" id="sirkulasiorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="sirkulasivisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="sirkulasitrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="sirkulasibody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="sirkulasidocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="sirkulasino_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="sirkulasip_type' + bodyId + '" type="hidden" value="ASES039" class="form-control" />')
        $("#formSirkulasi" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSirkulasi',
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
                    // $('#formSirkulasi' + bodyId + ' select').prop("disabled", true)
                    // $('#formSirkulasi' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formSirkulasiSaveBtn" + bodyId).hide()
                    $("#formSirkulasiEditBtn" + bodyId).show()
                    $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", true)
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
            $("#formSirkulasiSaveBtn" + bodyId).show()
            $("#formSirkulasiEditBtn" + bodyId).hide()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            $("#formSirkulasiSaveBtn" + bodyId).hide()
            $("#formSirkulasiEditBtn" + bodyId).show()
            $("#formSirkulasi" + bodyId).find("input, textarea, select").prop("disabled", true)
            var sirkulasi = sirkulasiAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES039') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(sirkulasi.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (sirkulasi.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES039' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(sirkulasi.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
        }
        index++
        $("#addSirkulasiButton").html('<a onclick="addSirkulasi(1,' + index + ',\'armpasien_diagnosa_id\', \'bodySirkulasiMedis\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSirkulasi(bodyId) {
        $("#bodySirkulasi").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSirkulasi',
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
                sirkulasiAll = data.sirkulasi
                $.each(sirkulasiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSirkulasi(0, key, "arpbody_id", "bodySirkulasi")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addSirkulasi(0, key, "armpasien_diagnosa_id", "bodySirkulasiMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addNeurosensoris(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = neuroAll[index].body_id
        }
        $("#bodyNeurosensoris").append(
            $('<form id="formNeurosensoris' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Neurosensoris"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES038') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES038' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formNeurosensorisSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formNeurosensorisEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES038' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formNeurosensoris" + bodyId).append('<input name="org_unit_code" id="neurosensorisorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="neurosensorisvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="neurosensoristrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="neurosensorisbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="neurosensorisdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="neurosensorisno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="neurosensorisp_type' + bodyId + '" type="hidden" value="ASES038" class="form-control" />')
        $("#formNeurosensoris" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveNeurosensoris',
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
                    $('#formNeurosensoris' + bodyId + ' select').find("input, select, textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formNeurosensorisSaveBtn" + bodyId).hide()
                    $("#formNeurosensorisEditBtn" + bodyId).show()
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

        $("#ASES03803" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES03805" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        if (flag == 1) {
            $("#formNeurosensorisSaveBtn" + bodyId).show()
            $("#formNeurosensorisEditBtn" + bodyId).hide()
        } else {

            $("#formNeurosensorisSaveBtn" + bodyId).show()
            $("#formNeurosensorisEditBtn" + bodyId).hide()

            var neuro = neuroAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES038') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(neuro.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (neuro.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES038' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(neuro.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $('#formNeurosensoris' + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addNeurosensorisButton").html('<a onclick="addNeurosensoris(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getNeurosensoris(bodyId) {
        $("#bodyNeurosensoris").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getNeurosensoris',
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
                neuroAll = data.neuro
                // stabilitasDetail = data.stabilitasDetail

                $.each(neuroAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addNeurosensoris(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addIntegumen(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = integumenAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formIntegumen' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Integumen"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES036') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES036' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formIntegumenSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formIntegumenEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES036' && $value1['value_score'] == '99') {
        ?>
                $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formIntegumen" + bodyId).append('<input name="org_unit_code" id="integumensorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="integumensvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="integumenstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="integumensbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="integumensdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="integumensno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="integumensp_type' + bodyId + '" type="hidden" value="ASES036" class="form-control" />')
        $("#formIntegumen" + bodyId).on('submit', (function(e) {
            $("#integumensdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveIntegumen',
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
                    $('#formIntegumen' + bodyId).find("input,select,textarea").prop("disabled", true)
                    clicked_submit_btn.button('reset');
                    $("#formIntegumenSaveBtn" + bodyId).hide()
                    $("formIntegumenEditBtn" + bodyId).show()
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

        $("#ASES03606" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#formIntegumenEditBtn" + bodyId).on("click", function() {
            $("#formIntegumenSaveBtn" + bodyId).show()
            $("#formIntegumenEditBtn" + bodyId).hide()
            $("#formIntegumen" + bodyId).find("input, select, textarea").prop("disabled", false)
        })
        if (flag == 1) {
            $("#formIntegumenSaveBtn" + bodyId).show()
            $("formIntegumenEditBtn" + bodyId).hide()
        } else {
            var integumen = integumenAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES036') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(integumen.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (integumen.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES036' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(integumen.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formIntegumenSaveBtn" + bodyId).hide()
            $("formIntegumenEditBtn" + bodyId).show()
            $("#formIntegumen" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addIntegumenButton").html('<a onclick="addIntegumen(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getIntegumen(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getIntegumen',
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
                integumenAll = data.integumen
                // stabilitasDetail = data.stabilitasDetail

                $.each(integumenAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyIntegumenPerawat").html("")
                        addIntegumen(0, key, "arpbody_id", "bodyIntegumenPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyIntegumenMedis").html("")
                        addIntegumen(0, key, "armpasien_diagnosa_id", "bodyIntegumenMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addADL(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = adlAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formADL' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Aktivitas dan Latihan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES016') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option value="99">-</option>') <?php foreach ($aValue as $key1 => $value1) {
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
                                                                                    if ($value['parameter_id'] == '06') {
                                                                                        break;
                                                                                    }
                                                                                }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES016' && in_array($value['parameter_id'], array('07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" class="form-control">')
                                                    .append('<option value="99">-</option>') <?php foreach ($aValue as $key1 => $value1) {
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
                                                                                }
                                                ?>
                        )
                    )
                    .append($('<div class="mb-3 row">')
                        .append($('<label class="col-md-2 col-form-label">Tingkat Ketergantungan ADL</label>'))
                        .append($('<div class="col-md-10">')
                            .append($('<select id="total_dependency' + bodyId + '" name="TOTAL_DEPENDENCY" class="form-control" readonly>'))
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formADLSave' + bodyId + '" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formADLEdit' + bodyId + '" onclick="" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES016' && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formADL" + bodyId).append('<input name="org_unit_code" id="ADLsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="ADLsvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="ADLstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="ADLsbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="ADLsdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="ADLsno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="ADLsp_type' + bodyId + '" type="hidden" value="ASES016" class="form-control" />')
        $("#formADL" + bodyId).on('submit', (function(e) {
            $("#ADLsdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveADL',
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
                    $('#formADL' + bodyId + ' select').prop("disabled", true)
                    $('#formADL' + bodyId + ' input').prop("disabled", true)
                    $("#formADLSave" + bodyId).hide()
                    $("#formADLEdit" + bodyId).show()
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
        $("#formADLEdit" + bodyId).on("click", function() {
            $("#formADLSave" + bodyId).show()
            $("#formADLEdit" + bodyId).hide()
            $("#formADL" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formADL" + bodyId).find("select").on("change", function(e) {
            var totalScoreAdl = 0;
            $("#formADL" + bodyId).find("select").each(function() {
                var selectValue = $(this).val();
                totalScoreAdl += parseInt(selectValue)
                if (totalScoreAdl > 19)
                    var scoreAdlName = 'Mandiri'
                else if (totalScoreAdl < 19 && totalScoreAdl >= 15)
                    var scoreAdlName = 'Ketergantungan Ringan'
                else if (totalScoreAdl < 15 && totalScoreAdl >= 10)
                    var scoreAdlName = 'Ketergantungan Sedang'
                else if (totalScoreAdl < 10 && totalScoreAdl >= 5)
                    var scoreAdlName = 'Ketergantungan Berat'

                $("#total_dependency" + bodyId).html("")
                $("#total_dependency" + bodyId).append($('<option value="' + totalScoreAdl + '">' + scoreAdlName + '</option>'))
            })
            console.log(totalScoreAdl)
        })

        if (flag == 1) {
            $("#formADLSave" + bodyId).show()
            $("#formADLEdit" + bodyId).hide()
        } else {
            $("#formADLSave" + bodyId).hide()
            $("#formADLEdit" + bodyId).show()
            var adl = adlAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES016') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(adl.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (adl.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES016' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?>' + bodyId).val(adl.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            var totalScoreAdl = 0;
            totalScoreAdl += parseInt(adl.total_dependency)
            if (totalScoreAdl > 19)
                var scoreAdlName = 'Mandiri'
            else if (totalScoreAdl < 19 && totalScoreAdl >= 15)
                var scoreAdlName = 'Ketergantungan Ringan'
            else if (totalScoreAdl < 15 && totalScoreAdl >= 10)
                var scoreAdlName = 'Ketergantungan Sedang'
            else if (totalScoreAdl < 10 && totalScoreAdl >= 5)
                var scoreAdlName = 'Ketergantungan Berat'

            $("#total_dependency" + bodyId).html("")
            $("#total_dependency" + bodyId).append($('<option value="' + totalScoreAdl + '">' + scoreAdlName + '</option>'))
            $("#formADL" + bodyId).find("input, textarea, select").prop("disabled", true)
        }

        index++
        $("#addADLButton").html('<a onclick="addADL(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getADL(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getADL',
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
                adlAll = data.adl
                // stabilitasDetail = data.stabilitasDetail

                $.each(adlAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyADLPerawat".html(""))
                        addADL(0, key, "arpbody_id", "bodyADLPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyADLMedis").html("")
                        addADL(0, key, "armapsien_diagnosa_id", "bodyADLMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addDekubitus(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = dekubitusAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formDekubitus' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Dekubitus"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES047') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES047' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formDekubitusSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formDekubitusEditBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary" style="display: none"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES047' && $value1['value_score'] == '99') {
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

        $("#formDekubitus" + bodyId).append('<input name="org_unit_code" id="dekubitusorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="dekubitusvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="dekubitustrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="dekubitusbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="dekubitusdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="dekubitusno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="dekubitusp_type' + bodyId + '" type="hidden" value="ASES047" class="form-control" />')
        $("#formDekubitus" + bodyId).on('submit', (function(e) {
            $("#dekubitusdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveDekubitus',
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
                    $('#formDekubitus' + bodyId + ' select').prop("disabled", true)
                    $('#formDekubitus' + bodyId + ' input').prop("disabled", true)
                    clicked_submit_btn.button('reset');

                    $("#formDekubitusSaveBtn" + bodyId).hide()
                    $("#formDekubitusEditBtn" + bodyId).show()
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


        $("#formDekubitusEditBtn" + bodyId).on("click", function() {
            $("#formDekubitusSaveBtn" + bodyId).show()
            $("#formDekubitusEditBtn" + bodyId).hide()
            $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        if (flag == 1) {
            $("#formDekubitusSaveBtn" + bodyId).show()
            $("#formDekubitusEditBtn" + bodyId).hide()
        } else {
            var digest = dekubitusAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES047') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES047' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formDekubitus" + bodyId).find("input, select, textarea").prop("disabled", true)
            $("#formDekubitusSaveBtn" + bodyId).hide()
            $("#formDekubitusEditBtn" + bodyId).show()



        }
        index++
        $("#addDekubitusButton").html('<a onclick="addDekubitus(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getDekubitus(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getDekubitus',
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
                dekubitusAll = data.dekubitus

                $.each(dekubitusAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addDekubitus(0, key, 'arpbody_id', "bodyDekubitusPerawat")
                    if (value.document_id == $("#armpasien_diagnosa_id").val())
                        addDekubitus(0, key, 'armpasien_diagnosa_id', "bodyDekubitusMedis")
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addPencernaan(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = digestAll[index].body_id
        }
        $("#bodyPencernaan").append(
            $('<form id="formPencernaan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Pencernaan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES040') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES040' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPencernaanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPencernaanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )
        $("#formPencernaanEditBtn").on("click", function() {
            $("#formPencernaan" + body).find("input, textarea, select").prop("disabled", false)
            $("#formPencernaanSaveBtn" + bodyId).show()
            $("#formPencernaanEditBtn" + bodyId).hide()
        })
        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES040' && $value1['value_score'] == '99') {
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

        $("#formPencernaan" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES040" class="form-control" />')
        $("#formPencernaan" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePencernaan',
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
                    $("#formPencernaan" + body).find("input, textarea, select").prop("disabled", true)
                    $("#formPencernaanSaveBtn" + bodyId).hide()
                    $("#formPencernaanEditBtn" + bodyId).show()
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
            $("#formPencernaan" + bodyId).find("input, textarea, select").prop("disabled", true)
            $("#formPencernaanSaveBtn" + bodyId).show()
            $("#formPencernaanEditBtn" + bodyId).hide()
        } else {
            var digest = digestAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES040') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES040' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formPencernaan" + bodyId).find("input, textarea, select").prop("disabled", true)
            $("#formPencernaanSaveBtn" + bodyId).hide()
            $("#formPencernaanEditBtn" + bodyId).show()
        }
        index++
        $("#addPencernaanButton").html('<a onclick="addPencernaan(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPencernaan(bodyId) {
        $("#bodyPencernaan").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPencernaan',
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
                digestAll = data.pencernaan
                // stabilitasDetail = data.stabilitasDetail

                $.each(digestAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPencernaan(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addPerkemihan(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = perkemihanAll[index].body_id
        }
        $("#bodyPerkemihan").append(
            $('<form id="formPerkemihan' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Perkemihan"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES042') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                        if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                                        )
                                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                                    if ($value['p_type'] == 'ASES042 ' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                                    ?>
                                                        .append($('<div class="row">')
                                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                                        ) <?php
                                                                                                        } else if ($value['entry_type'] == 2) {
                                                            ?>
                                                        .append($('<div class="form-group col-md-12">')
                                                            .append($('<div class="row">')
                                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                                ?>
                                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                                    ) <?php
                                                                                                                }
                                                                                                            } ?>
                                                        ) <?php
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
                                                                                                        if ($value['entry_type'] == 4) {
                                                            ?>
                                                        .append($('<div class="row">')
                                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                            .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                                        ) <?php
                                                                                                        } ?> <?php }
                                                                                                        }
                                                                                                                ?>
                                        )
                                    )
                        .append('<div class="panel-footer text-end mb-4">' +
                            '<button type="submit" id="formPerkemihanSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                            '<button style="margin-right: 10px" type="button" id="formPerkemihanEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                            '</div>')

                    )
                )
            )



            <?php foreach ($aValue as $key1 => $value1) {
                if ($value1['p_type'] == 'ASES042 ' && $value1['value_score'] == '99') {
            ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                        if ($(this).is(":checked")) {
                            $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                        } else {
                            console.log($(this).val())
                            $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                        }
                    }); <?php
                    }
                } ?>

            $("#formPerkemihan" + bodyId).append('<input name="org_unit_code" id="Perkemihansorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="Perkemihansvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="Perkemihanstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="Perkemihansbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="Perkemihansdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="Perkemihansno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="Perkemihansp_type' + bodyId + '" type="hidden" value="ASES042 " class="form-control" />')

            $("#formPerkemihanEditBtn" + bodyId).on("click", function() {
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", false)
                $("#formPerkemihanSaveBtn" + bodyId).show()
                $("#formPerkemihanEditBtn" + bodyId).hide()
            })

            $("#formPerkemihan" + bodyId).on('submit', (function(e) {
                let clicked_submit_btn = $(this).closest('form').find(':submit');
                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/rm/assessment/savePerkemihan',
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
                        $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", true)
                        $("#formPerkemihanSaveBtn" + bodyId).hide()
                        $("#formPerkemihanEditBtn" + bodyId).show()
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
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", false)
                $("#formPerkemihanSaveBtn" + bodyId).show()
                $("#formPerkemihanEditBtn" + bodyId).hide()

            } else {
                var perkemihan = perkemihanAll[index];
                <?php foreach ($aParameter as $key => $value) {
                    if ($value['p_type'] == 'ASES042') {
                        // if ($value['entry_type'] == '3') {
                        if (in_array($value['entry_type'], [1, 3, 4])) {
                ?>
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(perkemihan.<?= strtolower($value['column_name']); ?>)
                        <?php

                        } else if ($value['entry_type'] == '2') {
                        ?>
                            if (perkemihan.<?= strtolower($value['column_name']); ?> == 1) {
                                $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                                <?php foreach ($aValue as $key1 => $value1) {
                                    if ($value1['p_type'] == 'ASES042 ' && $value1['value_score'] == '99') {
                                ?>
                                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(perkemihan.<?= strtolower($value1['value_info']); ?>)
                                <?php
                                    }
                                } ?>
                            }
                <?php
                        }
                    }
                } ?>
                $("#formPerkemihan" + bodyId).find("input, textarea, select").prop("disabled", true)
                $("#formPerkemihanSaveBtn" + bodyId).hide()
                $("#formPerkemihanEditBtn" + bodyId).show()
            }
            index++
            $("#addPerkemihanButton").html('<a onclick="addPerkemihan(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        }

        function getPerkemihan(bodyId) {
            $("#bodyPerkemihan").html("")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/getPerkemihan',
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
                    perkemihanAll = data.perkemihan
                    // stabilitasDetail = data.stabilitasDetail

                    $.each(perkemihanAll, function(key, value) {
                        if (value.document_id == $("#arpbody_id").val())
                            addPerkemihan(0, key)
                    })
                },
                error: function() {

                }
            });
        }
</script>
<script type="text/javascript">
    function addPsikologi(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = psikologiAll[index].body_id
        }
        $("#bodyPsikologi").append(
            $('<form id="formPsikologi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Psikologi Spiritual"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES035') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES035' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                        .append($('<div class="row col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                .append($('<h4 class="card-title">Kondisi Pasien</h4>')))
                            .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                .append($('<table class="table table-hover">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'GIZI001') {
                                                                                ?>
                                            .append($('<tr>')
                                                .append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="val<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="val<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))
                                            ) <?php
                                                                                    }
                                                                                } ?>
                                )
                            )
                        )

                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formPsikologiSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formPsikologiEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )


        $("#formPsikologiEditBtn" + bodyId).on("click", function() {
            $("#formPsikologiSaveBtn" + bodyId).show()
            $("#formPsikologiEditBtn" + bodyId).hide()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES035' && $value1['value_score'] == '99') {
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

        $("#formPsikologi" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES035" class="form-control" />')
        $("#formPsikologi" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/savePsikologi',
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
                    $("#formPsikologiSaveBtn" + bodyId).hide()
                    $("#formPsikologiEditBtn" + bodyId).show()
                    $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", true)

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
            $("#formPsikologiSaveBtn" + bodyId).show()
            $("#formPsikologiEditBtn" + bodyId).hide()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var psikologi = psikologiAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES035') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(psikologi.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (psikologi.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES035' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(psikologi.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $.each(psikologiDetailAll, function(key, value) {
                if (value.body_id == psikologi.body_id) {
                    console.log("#val" + value.p_type + value.value_id + bodyId)
                    $("#val" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                }
            })

            $("#formPsikologiSaveBtn" + bodyId).hide()
            $("#formPsikologiEditBtn" + bodyId).show()
            $("#formPsikologi" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addPsikologiButton").html('<a onclick="addPsikologi(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getPsikologi(bodyId) {
        $("#bodyPsikologi").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPsikologi',
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
                psikologiAll = data.psikologi
                psikologiDetailAll = data.psikologiDetail

                $.each(psikologiAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addPsikologi(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addSeksual(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = seksualAll[index].body_id
        }
        $("#bodySeksual").append(
            $('<form id="formSeksual' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Seksual"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES043') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES043' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSeksualSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSeksualEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        $("#formSeksualEditBtn" + bodyId).on("click", function() {
            $("#formSeksualSaveBtn" + bodyId).show()
            $("#formSeksualEditBtn" + bodyId).hide()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", false)
        })

        $("#ASES04306").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $("#ASES04308").keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES043' && $value1['value_score'] == '99') {
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

        $("#formSeksual" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES043" class="form-control" />')
        $("#formSeksual" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSeksual',
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
                    $("#formSeksualSaveBtn" + bodyId).hide()
                    $("#formSeksualEditBtn" + bodyId).show()
                    $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", true)
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
            $("#formSeksualSaveBtn" + bodyId).show()
            $("#formSeksualEditBtn" + bodyId).hide()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", false)
        } else {
            var digest = seksualAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES043') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES043' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formSeksualSaveBtn" + bodyId).hide()
            $("#formSeksualEditBtn" + bodyId).show()
            $("#formSeksual" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        $("#addSeksualButton").html('<a onclick="addSeksual(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSeksual(bodyId) {
        $("#bodySeksual").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSeksual',
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
                seksualAll = data.seksual

                $.each(seksualAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSeksual(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addSocial(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = socialAll[index].body_id
        }
        $("#bodySocial").append(
            $('<form id="formSocial' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Social"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES037') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES037' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSocialSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSocialEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES037' && $value1['value_score'] == '99') {
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
        $("#formSocialEditBtn" + bodyId).on("click", function() {
            $("#formSocialSaveBtn" + bodyId).show()
            $("#formSocialEditBtn" + bodyId).hide()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", false)
        })
        $("#formSocial" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES037" class="form-control" />')
        $("#formSocial" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSocial',
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
                    $("#formSocialSaveBtn" + bodyId).hide()
                    $("#formSocialEditBtn" + bodyId).show()
                    $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", true)
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
            $("#formSocialSaveBtn" + bodyId).show()
            $("#formSocialEditBtn" + bodyId).hide()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            var digest = socialAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES037') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES037' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
            $("#formSocialSaveBtn" + bodyId).hide()
            $("#formSocialEditBtn" + bodyId).show()
            $("#formSocial" + bodyId).find("input, textarea, select").prop("disabled", true)
        }
        index++
        $("#addSocialButton").html('<a onclick="addSocial(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSocial(bodyId) {
        $("#bodySocial").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSocial',
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
                socialAll = data.social



                $.each(socialAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        addSocial(0, key)
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addHearing(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = hearingAll[index].body_id
        }
        $("#bodyHearing").append(
            $('<form id="formHearing' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Hearing"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES044') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES044' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formHearingSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formHearingEditBtn' + bodyId + '" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES044' && $value1['value_score'] == '99') {
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

        $("#formHearing" + bodyId).on("click", function() {
            $("#formHearingSaveBtn" + bodyId).show()
            $("#formHearingEditBtn" + bodyId).hide()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#formHearing" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES044" class="form-control" />')
        $("#formHearing" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveHearing',
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
                    $('#formHearing' + bodyId + ' select').prop("disabled", true)
                    $('#formHearing' + bodyId + ' input').prop("disabled", true)
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
            $("#formHearingSaveBtn" + bodyId).show()
            $("#formHearingEditBtn" + bodyId).hide()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            $("#formHearingSaveBtn" + bodyId).hide()
            $("#formHearingEditBtn" + bodyId).show()
            $("#formHearing" + bodyId).find("input, textarea, select").prop("disabled", true)

            var digest = hearingAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES044') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES044' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>

        }
        index++
        $("#addHearingButton").html('<a onclick="addHearing(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getHearing(bodyId) {
        $("#bodyHearing").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getHearing',
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
                hearingAll = data.hearing

                $.each(hearingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addHearing(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addSleeping(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = sleepingAll[index].body_id
        }
        $("#bodySleeping").append(
            $('<form id="formSleeping' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Sleeping"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES046') {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == 'ASES046' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formSleepingSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formSleepingEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
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

        $("#formSleepingEditBtn" + bodyId).on("click", function() {
            $("#formSleepingSaveBtn" + bodyId).show()
            $("#formSleepingEditBtn" + bodyId).hide()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#formSleeping" + bodyId).append('<input name="org_unit_code" id="stabilitasorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="stabilitasvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="stabilitastrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="stabilitasbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="stabilitasdocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="stabilitasno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="stabilitasp_type' + bodyId + '" type="hidden" value="ASES046" class="form-control" />')
        $("#formSleeping" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSleeping',
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
                    $('#formSleeping' + bodyId + ' select').prop("disabled", true)
                    $('#formSleeping' + bodyId + ' input').prop("disabled", true)
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
            $("#formSleepingSaveBtn" + bodyId).show()
            $("#formSleepingEditBtn" + bodyId).hide()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", false)

        } else {
            $("#formSleepingSaveBtn" + bodyId).hide()
            $("#formSleepingEditBtn" + bodyId).show()
            $("#formSleeping" + bodyId).find("input, textarea, select").prop("disabled", true)

            var digest = sleepingAll[index];
            console.log(digest)
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'ASES046') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(digest.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (digest.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(digest.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>

        }
        index++
        $("#addSleepingButton").html('<a onclick="addSleeping(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getSleeping(bodyId) {
        $("#bodySleeping").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getSleeping',
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
                sleepingAll = data.sleeping

                $.each(sleepingAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addSleeping(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addGizi(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = giziAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formGizi' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Gizi"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizimalnutrition_risk' + bodyId + '" class="col-md-4 col-form-label mb-4">Resiko Malnutrisi</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizimalnutrition_risk' + bodyId + '" name="malnutrition_risk" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizinutrition_consult' + bodyId + '" class="col-md-4 col-form-label mb-4">Perlu Konsultasi Gizi</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizinutrition_consult' + bodyId + '" name="nutrition_consult" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizioperation_elder' + bodyId + '" class="col-md-4 col-form-label mb-4">Pasien Operasi >= 65th?</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizioperation_elder' + bodyId + '" name="operation_elder" value="1"></div>')
                                )
                            )
                            .append($('<div class="form-group col-md-12">')
                                .append($('<div class="row">')
                                    .append('<label for="gizimalnutrition' + bodyId + '" class="col-md-4 col-form-label mb-4">Gangguan Makan</label>')
                                    .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="gizimalnutrition' + bodyId + '" name="malnutrition" value="1"></div>')
                                )
                            )
                        )
                    )
                    .append($('<div id="rowmalnutritiondetail' + bodyId + '" class="mb-3 row" style="display: none">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')


                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="" class="col-form-label mb-4">Masalah yang berhubungan dengan mal nutrisi</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI001') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )

                            .append($('<div class="mb-3 row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Lainnya</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="valueothers' + bodyId + '" name="others" placeholder=""></div>')
                            )

                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label class="col-form-label mb-4">Masalah makanan</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI002') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziGIZI00301' + bodyId + '" class="col-md-4 col-form-label mb-4">Nutrisi melalui NGT</label>')
                                .append('<input name="GIZI00301" class="form-check-input" type="checkbox" id="giziGIZI00301' + bodyId + '" value="1">')
                            )
                            .append($('<div class="mb-3 row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Tanggal pasang</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="datetime-local" id="valueothers' + bodyId + '" name="others" placeholder=""></div>')
                            )
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziGIZI004' + bodyId + '" class="col-form-label mb-4">Mukosa mulut / lidah</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="GIZI004" id="giziGIZI004' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                    if ($value['p_type'] == 'GIZI004' && $value['parameter_id'] == '01') {
                                                                                                                                ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                    }
                                                                                                                                } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="malnutrition_risk' + bodyId + '" class="col-form-label mb-4">Penyakit</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI005') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label id="giziGIZI00601' + bodyId + '" class="col-md-4 col-form-label mb-4">Intake Cairan (Fluid Intake</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="text" id="giziGIZI00601' + bodyId + '" name="GIZI00601" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label class="col-form-label mb-4">Gangguan Metabolik</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<table class="">') <?php foreach ($aParameter as $key => $value) {
                                                                        if ($value['p_type'] == 'GIZI007') {
                                                                    ?>
                                                .append($('<tr>').append($('<td>').html('<div class="form-check"><input name="<?= $value['p_type'] . $value['parameter_id']; ?>" class="form-check-input" type="checkbox" id="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '" value="1"><label class="form-check-label" for="gizi<?= $value['p_type'] . $value['parameter_id']; ?>' + bodyId + '"><?= $value['parameter_desc']; ?></label></div>'))) <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziGIZI00801' + bodyId + '" class="col-form-label mb-4">Status Gangguan Metabolik</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="GIZI00801" id="giziGIZI00801' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                        if ($value['p_type'] == 'GIZI008' && $value['parameter_id'] == '01') {
                                                                                                                                    ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                        }
                                                                                                                                    } ?>
                                    )
                                )
                            )
                        )
                    )

                    .append($('<div class="mb-3 row">')
                        .append($('<h4>').html('Skrining Gizi'))
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziage_cat' + bodyId + '" class="col-form-label mb-4">Kategori usia</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="age_cat" id="giziage_cat' + bodyId + '">')
                                        .append('<option value="21">Anak 0 - 24 Bulan</option>')
                                        .append('<option value="22">Anak 24 - 60 Bulan</option>')
                                        .append('<option value="23">Anak 5 - 18 tahun</option>')
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziweight' + bodyId + '" class="col-md-4 col-form-label mb-4">BB</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="number" step=".01" id="giziweight' + bodyId + '" name="weight" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append('<label for="giziheight' + bodyId + '" class="col-md-4 col-form-label mb-4">TB</label>')
                                .append('<div class="col-md-8"><input class="form-control" type="number" step=".01" id="giziheight' + bodyId + '" name="height" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append('<label for="gizimt' + bodyId + '" class="col-md-4 col-form-label mb-4">IMT</label>')
                                .append('<div class="col-md-8"><select class="form-control" type="text" id="gizimt' + bodyId + '" name="imt" placeholder="" readonly></select></div>')
                            )
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">')
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep1_score_imt' + bodyId + '" class="col-form-label mb-4">Step 1|Skor IMT</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step1_score_imt" id="gizistep1_score_imt' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                    if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '01') {
                                                                                                                                                ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                    }
                                                                                                                                                } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep2_score_wightloss' + bodyId + '" class="col-form-label mb-4">Step 2|Skor Penurunan BB</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step2_score_wightloss" id="gizistep2_score_wightloss' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                                if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '02') {
                                                                                                                                                            ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                                }
                                                                                                                                                            } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep3_score_acute_disease' + bodyId + '" class="col-form-label mb-4">Step 3|Skor Efek Penyakit Akut</label>')
                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="step3_score_acute_disease" id="gizistep3_score_acute_disease' + bodyId + '">') <?php foreach ($aValue as $key => $value) {
                                                                                                                                                                        if ($value['p_type'] == 'GIZI009' && $value['parameter_id'] == '03') {
                                                                                                                                                                    ?>
                                                .append('<option value="<?= $value['value_score']; ?>"><?= $value['value_desc']; ?></option>')

                                        <?php
                                                                                                                                                                        }
                                                                                                                                                                    } ?>
                                    )
                                )
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="gizistep4_score_malnutrition' + bodyId + '" class="col-form-label mb-4">Step 4|Resiko Malnutrisi Keseluruhan</label>')

                                )
                                .append('<div class="col-xs-12 col-sm-8 col-md-8"><input class="form-control" type="number" id="gizistep4_score_malnutrition' + bodyId + '" name="step4_score_malnutrition" placeholder=""></div>')
                            )
                            .append($('<div class="row">')
                                .append($('<div class="col-xs-12 col-sm-4 col-md-4">')
                                    .append('<label for="giziscore_desc' + bodyId + '" class="col-form-label mb-4">Step 5|Management Guidelines</label>')

                                )
                                .append($('<div class="col-xs-12 col-sm-8 col-md-8">')
                                    .append($('<select class="form-control" name="score_desc" id="giziscore_desc' + bodyId + '">')
                                        .append('<option value="21">Anak 0 - 24 Bulan</option>')
                                        .append('<option value="22">Anak 24 - 60 Bulan</option>')
                                        .append('<option value="23">Anak 5 - 18 tahun</option>')
                                    )
                                )
                            )
                        )
                    )
                    .append($('<div class="mb-3 row">'))
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formGiziSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGiziEditBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')
                )
            )
        )

        // GIZI011	0.00	18.50	Berat badan kurang (Underweight)
        // GIZI011	18.51	22.90	Berat badan Normal
        // GIZI011	23.00	24.90	Kelebihan berat Badan (Overwight)
        // GIZI011	25.00	29.90	Obesitas I
        // GIZI011	30.00	200.00	Obesitas II
        $("#gizimalnutrition" + bodyId).on("change", function() {
            if ($("#gizimalnutrition" + bodyId).is(":checked")) {
                $("#rowmalnutritiondetail" + bodyId).show()
            } else {
                $("#rowmalnutritiondetail" + bodyId).hide()
            }
        })

        $("#giziweight" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $('#giziweight' + bodyId).on("change", function() {
            var w = $('#giziweight' + bodyId).val()
            var h = $('#giziheight' + bodyId).val()
            w = parseFloat(w)
            h = parseFloat(h) / 100
            var imt = w / h / h
            var imtString = checkImt(imt.toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(imt);
            $("#gizistep1_score_imt" + bodyId).val(score1Imt(imt.toFixed(2)))
        })
        $("#giziheight" + bodyId).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
        });
        $('#giziheight' + bodyId).on("change", function() {
            var w = $('#giziweight' + bodyId).val()
            var h = $('#giziheight' + bodyId).val()
            w = parseFloat(w)
            h = parseFloat(h) / 100
            var imt = w / h / h
            var imtString = checkImt(imt.toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(imt);
            $("#gizistep1_score_imt" + bodyId).val(score1Imt(imt.toFixed(2)))
        })

        $("#formGiziEditBtn" + bodyId).on("click", function() {
            $("#formGiziSaveBtn" + bodyId).show()
            $("#formGiziEditBtn" + bodyId).hide()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", false)
        })

        $("#gizistep1_score_imt" + bodyId).on("change", function() {
            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })
        $("#gizistep2_score_wightloss" + bodyId).on("change", function() {

            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })
        $("#gizistep3_score_acute_disease" + bodyId).on("change", function() {

            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))
        })

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'ASES046' && $value1['value_score'] == '99') {
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

        $("#formGizi" + bodyId).append('<input name="org_unit_code" id="giziorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="gizivisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="gizitrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="gizibody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="gizidocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="gizino_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="thename" id="gizithename' + bodyId + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress" id="gizitheaddress' + bodyId + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="examination_date" id="giziexamination_date' + bodyId + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="clinic_id" id="giziclinic_id' + bodyId + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="employee_id" id="giziemployee_id' + bodyId + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="petugas_id" id="gizipetugas_id' + bodyId + '" type="hidden" value="<?= user()->username; ?>" class="form-control" />')
            .append('<input name="class_room_id" id="giziclass_room_id' + bodyId + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id" id="gizibed_id' + bodyId + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            // .append('<input name="no_registration" id="giziparent_id' + bodyId + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="p_type" id="gizip_type' + bodyId + '" type="hidden" value="ASES046" class="form-control" />')
        $("#formGizi" + bodyId).on('submit', (function(e) {
            $("#gizidocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveGizi',
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
                    $('#formGizi' + bodyId + ' select').prop("disabled", true)
                    $('#formGizi' + bodyId + ' input').prop("disabled", true)
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
            $("#formGiziSaveBtn" + bodyId).show()
            $("#formGiziEditBtn" + bodyId).hide()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", false)
        } else {
            var gizi = giziAll[index];

            if (gizi.malnutrition_risk == 1)
                $("#gizimalnutrition_risk" + bodyId).prop("checked", true)
            if (gizi.nutrition_consult == 1)
                $("#gizinutrition_consult" + bodyId).prop("checked", true)
            if (gizi.operation_elder == 1)
                $("#gizioperation_elder" + bodyId).prop("checked", true)
            if (gizi.malnutrition == 1) {
                $("#gizimalnutrition" + bodyId).prop("checked", true)
                $("#rowmalnutritiondetail" + bodyId).show()
            }
            $("#giziage_cat" + bodyId).val(gizi.age_cat)
            $("#giziweight" + bodyId).val(gizi.weight)
            $("#giziheight" + bodyId).val(gizi.height)
            var imtString = checkImt(parseFloat(gizi.imt).toFixed(2))
            $("#gizimt" + bodyId).html("");
            $("#gizimt" + bodyId).append('<option value="' + gizi.imt + '">' + imtString + '</option>');
            $("#gizimt" + bodyId).val(gizi.imt);
            $("#gizistep1_score_imt" + bodyId).val(gizi.step1_score_imt);
            $("#gizistep2_score_wightloss" + bodyId).val(gizi.step2_score_wightloss);
            $("#gizistep3_score_acute_disease" + bodyId).val(gizi.step3_score_acute_disease);
            var gizistep1_score_imt = $("#gizistep1_score_imt" + bodyId).val()
            var gizistep2_score_wightloss = $("#gizistep2_score_wightloss" + bodyId).val()
            var gizistep3_score_acute_disease = $("#gizistep3_score_acute_disease" + bodyId).val()

            var totalscore = parseInt(gizistep1_score_imt) + parseInt(gizistep2_score_wightloss) + parseInt(gizistep3_score_acute_disease)

            $("#gizistep4_score_malnutrition" + bodyId).val(totalscore)
            $("#giziscore_desc" + bodyId).val(step5Gizi(totalscore))

            $.each(giziDetailAll, function(key, value) {
                if (value.body_id == bodyId) {
                    if (value.p_type == 'GIZI001' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI002' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI003' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI004') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                    }
                    if (value.p_type == 'GIZI005') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI006' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI007' && value.value_score == 1) {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                    }
                    if (value.p_type == 'GIZI008') {
                        $("#gizi" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                    }
                }
                // if (value.p_type == 'GIZI006' && value.value_score == 1) {
                //     $("#gizi" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                // }
            })
            $("#formGiziSaveBtn" + bodyId).hide()
            $("#formGiziEditBtn" + bodyId).show()
            $("#formGizi" + bodyId).find("input, textarea, select").prop("disabled", true)
        }
        index++
        $("#addGiziButton").html('<a onclick="addGizi(1,' + index + ',\'' + document_id + '\', \'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function checkImt(score) {
        // GIZI011	0.00	18.50	Berat badan kurang (Underweight)
        // GIZI011	18.51	22.90	Berat badan Normal
        // GIZI011	23.00	24.90	Kelebihan berat Badan (Overwight)
        // GIZI011	25.00	29.90	Obesitas I
        // GIZI011	30.00	200.00	Obesitas II
        if (score <= 18.5) {
            return score + 'Berat badan kurang (Underweight)'
        } else if (score > 18.5 && score <= 22.9) {
            return score + ' Berat badan Normal'
        } else if (score > 22.9 && score <= 24.9) {
            return score + ' Kelebuhan berat Badan (overWeight)'
        } else if (score > 24.9 && score <= 29.9) {
            return score + ' Obesitas I'
        } else {
            return score + ' Obesitas II'
        }
    }

    function score1Imt(score) {
        if (score <= 18.5) {
            return '2'
        } else if (score > 18.5 && score <= 20) {
            return '1'
        } else if (score > 20) {
            return '0'
        }
    }

    function step5Gizi(score) {
        if (score <= 1) {
            return 'Resiko Rendah (Low Risk) - Routine Clinical Care'
        } else if (score > 1 && score <= 2) {
            return 'Resiko sedang (Medium Risk) - Observe'
        } else if (score > 2) {
            return 'Resiko Tinggi (High Risk) - Treat'
        }
    }

    function getGizi(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getGizi',
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
                giziAll = data.gizi
                giziDetailAll = data.giziDetail

                $.each(giziAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGiziPerawat").html("")
                        addGizi(0, key, "arpbody_id", "bodyGiziPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGiziMedis").html("")
                        addGizi(0, key, "armpasien_diagnosa_id", "bodyGiziMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<script type="text/javascript">
    function addEducationForm(flag, index, document_id, container) {
        var documentId = $("#" + document_id).val()
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = educationFormAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formEducationForm' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("Education Form"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">') <?php foreach ($aParameter as $key => $value) {
                                                                                        if ($value['p_type'] == 'GEN0013') {
                                                                                    ?> <?php if ($value['entry_type'] == 1) {
                                                                                        ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                            } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                    if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                    }
                                                                                                } ?>
                                        ) <?php
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
                                                                                            } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-12"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                        ) <?php
                                                                                            }
                                            ?> <?php }
                                                                                        if ($value['parameter_id'] == '09') {
                                                                                            break;
                                                                                        }
                                                                                    }
                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6" style="display: none">') <?php foreach ($aParameter as $key => $value) {
                                                                                                            if ($value['p_type'] == 'GEN0013' && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                                        ?> <?php if ($value['entry_type'] == 1) {
                                                                                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                                                } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                                        }
                                                                                                                    } ?>
                                        ) <?php
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
                                                                                                        }
                                                ?>
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formaddprescrbtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                        '</div>')

                )
            )
        )

        <?php foreach ($aParameter as $key => $value) {
            if ($value['p_type'] == 'GEN0013') {
        ?> <?php if ($value['entry_type'] == 4) {
            ?> tinymce.init({
                        selector: "#<?= $value['p_type'] . $value['parameter_id'] ?>" + bodyId,
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
        <?php }
            }
        } ?>

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == 'GEN0013 ' && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formEducationForm" + bodyId).append('<input name="org_unit_code" id="EducationFormsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="EducationFormsvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="EducationFormstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="EducationFormsbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="EducationFormsdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id="EducationFormsno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="EducationFormsp_type' + bodyId + '" type="hidden" value="GEN0013 " class="form-control" />')
        $("#formEducationForm" + bodyId).on('submit', (function(e) {
            $("#EducationFormsdocument_id" + bodyId).val($("#" + document_id).val())
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationForm',
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
                    $('#formEducationForm' + bodyId + ' select').prop("disabled", true)
                    $('#formEducationForm' + bodyId + ' input').prop("disabled", true)
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

        } else {
            var EducationForm = educationFormAll[index];
            <?php foreach ($aParameter as $key => $value) {
                if ($value['p_type'] == 'GEN0013') {
                    // if ($value['entry_type'] == '3') {
                    if (in_array($value['entry_type'], [1, 3, 4])) {
            ?>
                        $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).val(EducationForm.<?= strtolower($value['column_name']); ?>)
                    <?php

                    } else if ($value['entry_type'] == '2') {
                    ?>
                        if (EducationForm.<?= strtolower($value['column_name']); ?> == 1) {
                            $('#<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId).prop("checked", true)
                            <?php foreach ($aValue as $key1 => $value1) {
                                if ($value1['p_type'] == 'GEN0013 ' && $value1['value_score'] == '99') {
                            ?>
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId).val(EducationForm.<?= strtolower($value1['value_info']); ?>)
                            <?php
                                }
                            } ?>
                        }
            <?php
                    }
                }
            } ?>
        }
        index++
        $("#addEducationFormButton").html('<a onclick="addEducationForm(1,' + index + ', \'' + document_id + '\',\'' + container + '\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function getEducationForm(bodyId, container) {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationForm',
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
                educationFormAll = data.educationForm
                // stabilitasDetail = data.stabilitasDetail

                $.each(educationFormAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyEducationFormPerawat").html("")
                        addEducationForm(0, key, "arpbody_id", "bodyEducationFormPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyEducationFormMedis").html("")
                        addEducationForm(0, key, "armpasien_diagnosa_id", "bodyEducationFormMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addEducationIntegration(flag, index) {
        var bodyId = '';
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = educationIntegrationAll[index].body_id
        }
        <?php
        $ptype = 'ASES049';
        ?>
        $("#bodyEducationIntegration").append(
            $('<form id="formEducationIntegration' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("EducationIntegration"))
                    .append($('<div class="mb-3 row">')
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == $ptype) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 3) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append($('<div class="col-md-8">')
                                                .append($('<select id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="049<?= $value['parameter_id'] ?>" class="form-control">')
                                                    .append('<option>-</option>') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                    ?>
                                                            .append('<option value="<?= $value1['value_score']; ?>"><?= $value1['value_desc'] ?></option>') <?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                                )
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            )) <?php
                                                                                        } else if ($value['entry_type'] == 5) {
                                                                                        } else if ($value['entry_type'] == 6) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="checkbox" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 7) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="radio" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                            if ($value['parameter_id'] == '09') {
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-6 col-md-6">') <?php foreach ($aParameter as $key => $value) {
                                                                                    if ($value['p_type'] == $ptype  && in_array($value['parameter_id'], array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'))) {
                                                                                ?> <?php if ($value['entry_type'] == 1) {
                                                                                    ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                            .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></div>')
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 2) {
                                            ?>
                                        .append($('<div class="form-group col-md-12">')
                                            .append($('<div class="row">')
                                                .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>')
                                                .append('<div class="col-md-8"><input class="form-check-input" type="checkbox" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" value="1"></div>')
                                            ) <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id'] && $value1['value_score'] == '99') {
                                                ?>
                                                    .append($('<div id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId + '"  class="row" style="display: none;">')
                                                        .append('<label class="col-md-4 col-form-label mb-4"><?= $value1['value_desc']; ?></label>')
                                                        .append('<div class="col-md-8"><input class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?><?= $value1['value_id'] ?>' + bodyId + '" name="<?= $value1['value_info'] ?>" placeholder=""></div>')
                                                    ) <?php
                                                                                                }
                                                                                            } ?>
                                        ) <?php
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
                                                                                        } else if ($value['entry_type'] == 4) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append('<label class="col-md-4 col-form-label mb-4"><?= $value['parameter_desc']; ?></label>'
                                                .append('<div class="col-md-8"><textarea class="form-control" type="text" id="<?= $value['p_type'] . $value['parameter_id'] ?>' + bodyId + '" name="<?= $value['column_name'] ?>" placeholder=""></textarea></div>')
                                            )) <?php
                                                                                        } else if ($value['entry_type'] == 5) {
                                                                                        } else if ($value['entry_type'] == 6) {
                                                ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="checkbox" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">>' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } else if ($value['entry_type'] == 7) {
                                            ?>
                                        .append($('<div class="row">')
                                            .append($('<div class="col-md-4">')
                                                .append($('<h5 class="font-size-14 mb-4"><?= $value['parameter_desc']; ?></h5>'))
                                            )
                                            .append($('<div class="col-md-8">') <?php foreach ($aValue as $key1 => $value1) {
                                                                                                if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                                                                ?>
                                                        .append($('<div class="form-check mb-3">' +
                                                            '<input id="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '" class="form-check-input" type="radio" name="<?= $value1['value_info']; ?>" value="<?= $value1['value_score']; ?>">' +
                                                            '<label class="form-check-label" for="educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>' + bodyId + '">' +
                                                            '<?= $value1['value_desc']; ?>' +
                                                            '</label>' +
                                                            '</div>')) <?php
                                                                                                }
                                                                                            } ?>
                                            )
                                        ) <?php
                                                                                        } ?> <?php }
                                                                                        }
                                                                                                ?>
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Bahasa Sehari-hari</h5>'))
                            .append($('<table id="educationIntegrationLanguage' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Bahasa</th><th width="50">Status</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguageBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationLanguage(\'' + bodyId + '\')" class="btn btn-info btn-sm" id="" style="width: 200px"><i class=" fa fa-plus"></i> Tambah Dokumen</a></div>' +
                                '</div>)'))
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Perencanaan Edukasi</h5>'))
                            .append($('<table id="educationIntegrationLanguagePlan' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Kebutuhan Edukasi</th>')
                                        .append('<th width="50">Pemberian Edukasi</th>')
                                        .append('<th width="50">Tanggal/Jam Edukasi</th>')
                                        .append('<th width="50">Sasaran Edukasi</th>')
                                        .append('<th width="50">Metode Edukasi</th>')
                                        .append('<th width="50">Metode Evaluasi</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguagePlanBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationPlan(\'' + bodyId + '\')" class="btn btn-info btn-sm" id="" style="width: 200px"><i class=" fa fa-plus"></i> Tambah</a></div>' +
                                '</div>)'))
                        )
                        .append($('<div class="col-xs-12 col-sm-12 col-md-12">')
                            .append($('<h5>Daftar Pemberian Edukasi</h5>'))
                            .append($('<table id="educationIntegrationLanguageProvision' + bodyId + '" class="table table-striped">')
                                .append($('<thead>')
                                    .append($('<tr>')
                                        .append('<th width="50">Judul Edukasi</th>')
                                        .append('<th width="50">Tanggal/jam Edukasi</th>')
                                        .append('<th width="50">Tingkat Pemahaman Awal</th>')
                                        .append('<th width="50">Assessmen Ulang</th>')
                                        .append('<th width="50">Evaluasi/Verifikasi</th>')
                                        .append('<th width="50">Staff Name</th>')
                                    )
                                )
                                .append($('<tbody id="educationIntegrationLanguageProvisionBody' + bodyId + '">'))
                            )
                            .append($('<div class="col-md-12">' +
                                '<div class="box-tab-tools text-center"><a onclick="addEducationIntegrationProvision(\'' + bodyId + '\')" class="btn btn-info btn-sm" id="" style="width: 200px"><i class=" fa fa-plus"></i> Tambah</a></div>' +
                                '</div>)'))
                        )
                        .append('<div class="panel-footer text-end mb-4">' +
                            '<button type="submit" id="formaddprescrbtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                            '<button style="margin-right: 10px" type="button" id="historyprescbtn" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
                            '</div>')

                    )
                )
            )
        )

        <?php foreach ($aValue as $key1 => $value1) {
            if ($value1['p_type'] == $ptype && $value1['value_score'] == '99') {
        ?> $("#<?= $value1['p_type'] . $value1['parameter_id'] ?>" + bodyId).change(function() {
                    $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()

                    if ($(this).is(":checked")) {
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).show()
                    } else {
                        console.log($(this).val())
                        $('#<?= $value1['p_type'] . $value1['parameter_id'] ?><?= $value1['value_id'] ?>group' + bodyId).hide()
                    }
                });
        <?php
            }
        } ?>

        $("#formEducationIntegration" + bodyId).append('<input name="org_unit_code" id="EducationIntegrationsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id="educationintegraitonvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id="educationintegraitontrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id="educationintegraitonbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id="educationintegraitondocument_id' + bodyId + '" type="hidden" value="' + $("#arpbody_id").val() + '" class="form-control" />')
            .append('<input name="no_registration" id="educationintegraitonno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id="educationintegraitonp_type' + bodyId + '" type="hidden" value="<?= $ptype; ?>" class="form-control" />')
            .append('<input name="examination_date" id="educationintegraitonexamination_date' + bodyId + '" type="hidden" value="' + get_date() + ' " class="form-control" />')

        $("#formEducationIntegration" + bodyId).on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegration',
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
                    $('#formEducationIntegration' + bodyId + ' select').prop("disabled", true)
                    $('#formEducationIntegration' + bodyId + ' input').prop("disabled", true)
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

        } else {
            var eduInt = educationIntegrationAll[index];

            $.each(eduInt, function(key, value) {
                $("#educationintegraiton".key).val(value)
            })
            $.each(educationIntegrationDetailAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    if (value.p_type == 'ASES049') {
                        <?php foreach ($aParameter as $key => $value) {
                            if ($value['p_type'] == $ptype) {
                                if ($value['entry_type'] == 3) {
                        ?>
                                    if (value.parameter_id == '<?= $value['parameter_id']; ?>')
                                        $("#" + value.p_type + value.parameter_id + bodyId).val(value.value_score)
                                    <?php
                                }
                                if ($value['entry_type'] == 6) {
                                    foreach ($aValue as $key1 => $value1) {
                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                    ?>
                                            if (value.parameter_id == '<?= $value['parameter_id']; ?>' && value.value_id == <?= $value1['value_id']; ?>)
                                                $("#educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>" + bodyId).prop("checked", true)
                                        <?php
                                        }
                                    }
                                }
                                if ($value['entry_type'] == 7) {
                                    foreach ($aValue as $key1 => $value1) {
                                        if ($value1['p_type'] == $value['p_type'] && $value1['parameter_id'] == $value['parameter_id']) {
                                        ?>
                                            if (value.parameter_id == '<?= $value['parameter_id']; ?>' && value.value_id == <?= $value1['value_id']; ?>)
                                                $("#educationintegration<?= $value1['value_info'] . $value1['value_id']; ?>" + bodyId).prop("checked", true)
                        <?php
                                        }
                                    }
                                }
                            }
                        } ?>
                    } else if (value.p_type == 'GEN0014') {
                        console.log(value.value_id)
                        addEducationIntegrationLanguage(bodyId, value.parameter_id, value.value_desc)
                    }
                }
            })
            $.each(educationIntegrationPlanAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    addRowEducationIntegrationPlan(value)
                }
            })
            $.each(educationIntegrationProvisionAll, function(key, value) {
                if (value.body_id == eduInt.body_id) {
                    addRowEducationIntegrationProvision(value)
                }
            })
        }
        index++
        $("#addEducationIntegrationButton").html('<a onclick="addEducationIntegration(1,' + index + ')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
    }

    function addEducationIntegrationLanguage(bodyId, language, isactive) {
        var rowcount = $("#educationIntegrationLanguageBody tr").length + 1;
        $("#educationIntegrationLanguageBody" + bodyId).append($('<tr>')
            .append($('<td>')
                .append($('<select id="GEN0014Bahasa' + bodyId + rowcount + '" name="GEN0014Bahasa[]" class="form-control">') <?php foreach ($aParameter as $key => $value) {
                                                                                                                                    if ($value['p_type'] == 'GEN0014')
                                                                                                                                        echo '.append(\'<option value="' . $value['parameter_id'] . '">' . $value['parameter_desc'] . '</option>\')';
                                                                                                                                } ?>)
            )
            .append($('<td>')
                .append($('<select id="GEN0014Aktif' + bodyId + rowcount + '" name="GEN0014Aktif[]" class="form-control">')
                    .append($('<option value="1">Aktif</option>'))
                    .append($('<option value="0">Pasif</option>'))
                )
            )
        )
        $("#GEN0014Bahasa" + bodyId + rowcount).val(language)
        $("#GEN0014Aktif" + bodyId + rowcount).val(isactive)
    }

    function addEducationIntegrationPlan(bodyId, flag) {
        $("#addEducationListPlan").modal('show')
        $("#eduplanbody_id").val(bodyId)
        $("#eduplanp_type").val('<?= $ptype; ?>')
        var lng = $("#educationIntegrationLanguagePlanBody" + bodyId + " tr").length + 1
        $("#eduplanplan_ke").val(lng)
    }

    function addRowEducationIntegrationPlan(value) {
        var edutreatment_type = [
            '',
            'Pengertian penyakit',
            'Gizi',
            'Farmasi',
            'Rehabilitasi Medik',
            'Nyeri dan Manajemen Nyeri',
            'Pencegahan dan Pengendalian Infeksi',
            'Pelayanan Saat Pelayanan di RS'
        ]
        var edueducation_provision = [
            '', 'Perawat', 'Dokter', 'Ahli Gizi', 'Terapis', 'Bidan', 'Lain-lain'
        ]
        var edueducation_target = [
            '', 'Pasien', 'Dokter', 'Ahli Gizi'
        ]
        var edueducation_method = [
            '', 'Leaflet', 'Demonstrasi', 'Wawancara'
        ]
        $("#educationIntegrationLanguagePlanBody" + value.body_id)
            .append($('<tr>')
                .append($('<td>').html(edutreatment_type[value.treatment_type]))
                .append($('<td>').html(edueducation_provision[value.education_provision]))
                .append($('<td>').html(value.examination_date))
                .append($('<td>').html(edueducation_target[value.education_target]))
                .append($('<td>').html(edueducation_method[value.education_method]))
                .append($('<td>').html(value.education_evaluation))
            )
    }

    function addEducationIntegrationProvision(bodyId, flag) {
        $("#addEducationListProvision").modal('show')
        $("#eduprovbody_id").val(bodyId)
        $("#eduprovp_type").val('<?= $ptype; ?>')
        var lng = $("#educationIntegrationLanguageProvisionBody" + bodyId + " tr").length + 1
        $("#eduprovprovision_ke").val(lng)
    }

    function addRowEducationIntegrationProvision(value) {
        var edutreatment_type = [
            '',
            'Pengertian penyakit',
            'Gizi',
            'Farmasi',
            'Rehabilitasi Medik',
            'Nyeri dan Manajemen Nyeri',
            'Pencegahan dan Pengendalian Infeksi',
            'Pelayanan Saat Pelayanan di RS'
        ]
        var edueducation_provision = [
            '', 'Perawat', 'Dokter', 'Ahli Gizi', 'Terapis', 'Bidan', 'Lain-lain'
        ]
        var edueducation_target = [
            '', 'Pasien', 'Dokter', 'Ahli Gizi'
        ]
        var edueducation_method = [
            '', 'Leaflet', 'Demonstrasi', 'Wawancara'
        ]
        var eduunderstanding_level = [
            '', 'Sudah Mengerti', 'Edukasi Ulang', 'Hal Baru'
        ]
        var eduevaluation = [
            '', 'Sudah Mengerti', 'Re-Edukasi', 'Re-Demo'
        ]

        if (value.re_assessment == '1') {
            var reas = 'Ya'
        } else {
            var reas = 'Tidak'
        }
        $("#educationIntegrationLanguageProvisionBody" + value.body_id)
            .append($('<tr>')
                .append($('<td>').html(edutreatment_type[value.treatment_type]))
                .append($('<td>').html(value.examination_date))
                .append($('<td>').html(eduunderstanding_level[value.understanding_level]))
                .append($('<td>').html(reas))
                .append($('<td>').html(eduevaluation[value.evaluation]))
                .append($('<td>').html(value.modified_by))
            )
    }

    function saveEducationIntegrationPlan() {
        let clicked_submit_btn = $("#formEducationIntegrationPlanBtn");
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegrationPlan',
            type: "POST",
            data: new FormData(document.getElementById("formEducationIntegrationPlan")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                $("#addEducationListPlan").modal('hide')
                educationIntegrationPlanAll.push(data)

                $("#educationIntegrationLanguagePlanBody" + $("#eduplanbody_id").val()).html("")
                $.each(educationIntegrationPlanAll, function(key, value) {
                    addRowEducationIntegrationPlan(value)
                })

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
    }

    function saveEducationIntegrationProvision() {
        let clicked_submit_btn = $("#formEducationIntegrationProvisionBtn");
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveEducationIntegrationProvision',
            type: "POST",
            data: new FormData(document.getElementById("formEducationIntegrationProvision")),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                $("#addEducationListProvision").modal('hide')
                educationIntegrationProvisionAll.push(data)

                $("#educationIntegrationLanguageProvisionBody" + $("#eduprovisionbody_id").val()).html("")
                $.each(educationIntegrationProvisionAll, function(key, value) {
                    addRowEducationIntegrationProvision(value)
                })

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
    }

    function getEducationIntegration(bodyId) {
        $("#bodyEducationIntegration").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationIntegration',
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
                educationIntegrationAll = data.educationIntegration
                educationIntegrationDetailAll = data.educationIntegrationDetail
                educationIntegrationPlanAll = data.educationPlan
                educationIntegrationProvisionAll = data.educationProvision
                // stabilitasDetail = data.stabilitasDetail

                $.each(educationIntegrationAll, function(key, value) {
                    if (value.document_id == $("#arpbody_id").val())
                        addEducationIntegration(0, key)
                })
            },
            error: function() {

            }
        });
    }
</script>
<script type="text/javascript">
    function addGcs(flag, index, document_id, container, isaddbutton = true) {
        var bodyId = '';
        var documentId = $("#" + document_id).val()
        if (flag == 1) {
            const date = new Date();
            bodyId = date.toISOString().substring(0, 23);
            bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        } else {
            bodyId = gcsAll[index].body_id
        }
        $("#" + container).append(
            $('<form id="formGcs' + bodyId + '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="mt-4">')
            .append(
                $('<div class="card border border-1 rounded-4 m-4 p-4">')
                .append($('<div class="card-body">')
                    .append($('<h4 class="card-title">').html("GCS"))
                    .append(`<div class="row mb-4">
                            <div class="col-md-3">
                                <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Tanggal:</h5>
                            </div>
                            <div class="col-md-9">
                                <input id="gcsexamination_date` + bodyId + `" name="examination_date" type="datetime-local" class="form-control" value="` + get_date() + `">
                            </div>
                        </div>`)
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
                                                            .append('<option value="<?= $value1['value_score']; ?>">[<?= $value1['value_score']; ?>] <?= $value1['value_desc'] ?></option>') <?php
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
                                .append('<label class="col-md-4 col-form-label mb-4">Score</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<input type="text" id="GCS_SCORE' + bodyId + '" name="GCS_SCORE" class="form-control">'))
                                )
                            )
                            .append($('<div class="row">')
                                .append('<label class="col-md-4 col-form-label mb-4">Kesimpulan</label>')
                                .append($('<div class="col-md-8">')
                                    .append($('<select id="GCS_DESC' + bodyId + '" name="GCS_DESC" class="form-control">')
                                        .append('<option>-</option>')
                                        .append('<option value="1">Composmentis</option>')
                                        .append('<option value="2">Apatis</option>')
                                        .append('<option value="3">Delirium</option>')
                                        .append('<option value="4">Samnolen</option>')
                                        .append('<option value="5">Sopor</option>')
                                        .append('<option value="6">Coma</option>')
                                    )
                                )
                            )
                        )
                    )
                    .append('<div class="panel-footer text-end mb-4">' +
                        '<button type="submit" id="formGcsSaveBtn' + bodyId + '" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>' +
                        '<button style="margin-right: 10px" type="button" id="formGcsEditBtn' + bodyId + '" onclick="" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-history"></i> <span>Edit</span></button>' +
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
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1

            console.log(conclutionScore)


            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })
        $("#GEN001102" + bodyId).on("change", function() {
            var e = $("#GEN001101" + bodyId).val()
            var m = $("#GEN001102" + bodyId).val()
            var v = $("#GEN001103" + bodyId).val()

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1

            console.log(conclutionScore)


            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })
        $("#GEN001103" + bodyId).on("change", function() {
            var e = $("#GEN001101" + bodyId).val()
            var m = $("#GEN001102" + bodyId).val()
            var v = $("#GEN001103" + bodyId).val()

            var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
            var conclutionScore = 0
            if (totalScore >= 3 && totalScore <= 4)
                conclutionScore = 6
            if (totalScore > 4 && totalScore <= 6)
                conclutionScore = 5
            if (totalScore > 6 && totalScore <= 9)
                conclutionScore = 4
            if (totalScore > 9 && totalScore <= 11)
                conclutionScore = 3
            if (totalScore > 11 && totalScore <= 13)
                conclutionScore = 2
            if (totalScore > 13 && totalScore <= 15)
                conclutionScore = 1

            console.log(conclutionScore)


            $('#GCS_SCORE' + bodyId).val(totalScore)
            $('#GCS_DESC' + bodyId).val(conclutionScore)
        })

        $("#formGcsEditBtn" + bodyId).on("click", function() {
            $("#formGcsSaveBtn" + bodyId).show()
            $("#formGcsEditBtn" + bodyId).hide()
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", false)
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

        $("#formGcs" + bodyId).append('<input name="org_unit_code" id=gcsorg_unit_code' + bodyId + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="visit_id" id=gcsvisit_id' + bodyId + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="trans_id" id=gcstrans_id' + bodyId + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="body_id" id=gcsbody_id' + bodyId + '" type="hidden" value="' + bodyId + '" class="form-control" />')
            .append('<input name="document_id" id=gcsdocument_id' + bodyId + '" type="hidden" value="' + documentId + '" class="form-control" />')
            .append('<input name="no_registration" id=gcsno_registration' + bodyId + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="p_type" id=gcsp_type' + bodyId + '" type="hidden" value="GEN0011" class="form-control" />')
            .append('<input name="modified_by" id=gcsmodified_by' + bodyId + '" type="hidden" value="<?= user()->username; ?>" class="form-control" />')
        $("#formGcs" + bodyId).on('submit', (function(e) {
            $("#gcsdocument_id" + bodyId).val($("#" + document_id).val())
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
                    $("#formGcsSaveBtn" + bodyId).hide()
                    $("#formGcsEditBtn" + bodyId).show()
                    $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", true)

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
            $("#formGcsSaveBtn" + bodyId).show()
            $("#formGcsEditBtn" + bodyId).hide()
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", false)
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
            $("#GCS_SCORE" + bodyId).val(gcs.gcs_score)
            $("#GCS_DESCRIPTION" + bodyId).val(gcs.gcs_score)
            $.each(gcsDetailAll, function(key, value) {
                if (value.body_id == gcs.body_id) {
                    console.log("#val" + value.p_type + value.value_id + bodyId)
                    $("#val" + value.p_type + value.parameter_id + bodyId).prop("checked", true)
                }
            })

            $("#formGcsSaveBtn" + bodyId).hide()
            $("#formGcsEditBtn" + bodyId).show()
            $("#formGcs" + bodyId).find("input, select, textarea").prop("disabled", true)
        }
        index++
        if (isaddbutton)
            $("#addGcsButton").html('<a onclick="addGcs(1,' + index + ',\'armpasien_diagnosa_id\', \'bodyGcsMedis\')" class="btn btn-primary btn-lg" id="addNrBtn" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>')
        else
            $("#" + container + "AddBtn").html("")
    }

    function getGcs(bodyId, container) {
        $("#" + container).html("")
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
                    if (value.document_id == $("#arpbody_id").val()) {
                        $("#bodyGcsPerawat").html("")
                        addGcs(0, key, "arpbody_id", "bodyGcsPerawat")
                    }
                    if (value.document_id == $("#armpasien_diagnosa_id").val()) {
                        $("#bodyGcsMedis").html()
                        addGcs(0, key, "armpasien_diagnosa_id", "bodyGcsMedis")
                    }
                })
            },
            error: function() {

            }
        });
    }
</script>

<script>
    function cetakAssessmenKeperawatan() {
        $.ajax({
            url: '<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val(),
            type: "GET",
            success: function(data) {
                // Insert fetched content into modal
                // $("#cetakarpbody").html(data);
                $("#pdfFrame").attr("src", "data:application/pdf;base64," + data);
                // Display the modal
                $("#cetakarp").modal('show');
            }
        });
    }
</script>