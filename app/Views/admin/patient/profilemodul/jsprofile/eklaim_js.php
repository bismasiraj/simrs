<script type="text/javascript">
    function showHideEklaim(param, showhide) {
        if (showhide == 1) {
            $("." + param).show()
        } else if (showhide == 0) {
            $("." + param).hide()
        }
    }
    $(".upgradeClassParam").hide()
    $(".icuParam").hide()
    $(".apgarParam").hide()
    $(".persalinanParam").hide()
    $(".covidParam").hide()
    var iUnuDiag = 0;
    var iUnuProc = 0;
    var iInaDiag = 0;
    var iInaProc = 0;
    var currentStep = 0;
    var ekklaim_final = 0;

    var eklaimCaraKeluar = [];
    eklaimCaraKeluar[0] = 5;
    eklaimCaraKeluar[1] = 1;
    eklaimCaraKeluar[2] = 2;
    eklaimCaraKeluar[3] = 4;
    eklaimCaraKeluar[4] = 4;
    eklaimCaraKeluar[5] = 3;
    eklaimCaraKeluar[6] = 5;
    eklaimCaraKeluar[7] = 1;
    eklaimCaraKeluar[32] = 5;
    eklaimCaraKeluar[33] = 5;
    eklaimCaraKeluar[35] = 5;
    eklaimCaraKeluar[36] = 5;

    var ektrans_id = '<?= $visit['trans_id']; ?>'
    var ekvisit_id = '<?= $visit['visit_id']; ?>'
    var eknosep = '<?= $visit['no_skp']; ?>'
    var eknosep_inap = '<?= $visit['no_skpinap']; ?>'
    var eknomor_kartu = '<?= $visit['pasien_id']; ?>'
    var eknomor_sep = '<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>'
    var eknomor_rm = '<?= $visit['no_registration']; ?>'
    var eknama_pasien = '<?= $visit['diantar_oleh']; ?>'
    var ekgender = '<?= $visit['gender']; ?>'
    var ektgl_lahir = ''
    var ekpayor_id = '3'
    var ekpayor_cd = 'JKN'
    var ekcob_cd = '-'

    var ekjenis_rawat = '<?= !isset($visit['no_skpinap']) || is_null($visit['no_skpinap']) ? 2 : 1; ?>'
    var ektgl_masuk = '<?= $visit['visit_date']; ?>'
    var ektgl_pulang = '<?= $visit['no_skpinap'] == '' || is_null($visit['no_skpinap']) ? $visit['visit_date'] : $visit['exit_date']; ?>'
    var ekcara_masuk = '<?php if ($visit['asalrujukan'] == '1') {
                            echo 'gp';
                        } else if ($visit['asalrujukan'] == '2') {
                            echo 'hosp-trans';
                        } ?>'
    var ekdischarge_status = eklaimCaraKeluar['<?= $visit['keluar_id']; ?>']
    <?php $empl = user()->getEmployeeData() ?>
    var ekcoder_nik = '1771051804810003' //'<?= isset($empl['npk']) ? $empl['npk'] : ''; ?>'
    var eknama_dokter = '<?= is_null($visit['fullname_inap']) || $visit['fullname_inap'] == '' ? $visit['fullname'] : $visit['fullname_inap']; ?>'
    var ektarif_poli_eks = 10000
    var ekkode_tarif = 'BP'
    var ektension_upper = $("#aetension_upper").val()
    var ektension_below = $("#aetension_below").val()
    var ekadl_sub_acute = ''
    var ekadl_chronic = ''
    var ekdializer_single_use = ''
    var ekkantong_darah = ''
    var ekkelas_rawat = '<?= is_null($visit['class_room_id']) ? ($visit['kdpoli_eks'] == '0' ? '3' : '1') : ($visit['class_id_plafond'] - 1); ?>'
    var ekbirth_weight = 0;

    var ekupgrade_class_ind = '<?=
                                (in_array($visit['class_id_plafond'], ['2', '3'])
                                    && in_array(($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id']), ['3', '4'])
                                    && ($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id']) > $visit['class_id_plafond'] ? $visit['class_id_plafond'] : ($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id'])
                                ) != $visit['class_id_plafond'] ? '1' : '0'
                                ?>'
    var ekupgrade_class_class = '<?php switch ($visit['class_id']) {
                                        case '3':
                                            echo 'kelas_2';
                                            break;
                                        case '2':
                                            echo 'kelas_1';
                                            break;
                                        case '6':
                                            echo 'vip';
                                            break;
                                        case '11':
                                            echo 'vip';
                                            break;
                                    } ?>'
    var ekupgrade_class_los = ''
    var ekadd_payment_pct = '75'
    var ekupgrade_class_payor = ''

    var ekicu_indikator = ''
    var ekicu_los = ''
    var ekventilator_hour = ''
    var ekuse_ind = ''
    var ekstart_dttm = ''
    var ekstop_dttm = ''

    var ekapgar = ''
    var ekappearance = ''
    var ekpulse = ''
    var ekgrimace = ''
    var ekactivity = ''
    var ekrespiration = ''

    var ekpersalinan = ''
    var ekusia_kehamilan = ''
    var ekonset_kontraksi = ''
    var ekgravida = ''
    var ekpartus = ''
    var ekabortus = ''
    var ekdelivery_method = ''
    var ekuse_manual = ''
    var ekuse_forcep = ''
    var ekuse_vacuum = ''
    var ekletak_janin = ''
    var ekkondisi = ''

    var ekcovid_indicator = ''
    var ekcovid19_status_cd = ''
    var ekcovid19_no_sep = ''
    var eknomor_kartu_t = ''
    var ekterapi_konvalesen = ''
    var ekisoman_ind = ''
    var ekbayi_lahir_status_cd = ''
    var ekcovid19_rs_darurat_ind = ''
    var ekcovid19_cc_ind = ''
    var ekcovid19_co_insidense_ind = ''
    var ekepisodes7 = ''
    var ekepisodes8 = ''
    var ekepisodes9 = ''
    var ekepisodes10 = ''
    var ekepisodes11 = ''
    var ekepisodes12 = ''
    var eklab_asam_laktat = ''
    var eklab_d_dimer = ''
    var eklab_anti_hiv = ''
    var eklab_procalcitonin = ''
    var eklab_analisa_gas = ''
    var eklab_crp = ''
    var eklab_pt = '';
    var eklab_aptt = ''
    var eklab_albumin = ''
    var eklab_kultur = ''
    var eklab_waktu_pendarahan = ''
    var ekrad_thorax_ap_pa = ''
    var ekpemulasaraan_jenazah = ''
    var ekkantong_jenazah = ''
    var ekpeti_jenazah = ''
    var ekplastik_erat = ''
    var ekdesinfektan_jenazah = ''
    var ekmobil_jenazah = ''
    var ekdesinfektan_mobil_jenazah = ''

    var ekprosedur_non_bedah = 0.0;
    var ekprosedur_bedah = 0.0;
    var ekkonsultasi = 0.0;
    var ektenaga_ahli = 0.0;
    var ekkeperawatan = 0.0;
    var ekpenunjang = 0.0;
    var ekradiologi = 0.0;
    var eklaboratorium = 0.0;
    var ekpelayanan_darah = 0.0;
    var ekrehabilitasi = 0.0;
    var ekkamar = 0.0;
    var ekrawat_intensif = 0.0;
    var eksewa_alat = 0.0;
    var ekobat = 0.0;
    var ekobat_kronis = 0.0;
    var ekobat_kemoterapi = 0.0;
    var ekalkes = 0.0;
    var ekbmhp = 0.0;
    var ektotalBillEklaim = 0.0;
</script>

<script type="text/javascript">
    $(document).ready(function(e) {
        setEklaimData()
        // var trans = '<?= $visit['trans_id']; ?>'
        // getBillEklaim18(trans)

        getEklaimData(eknomor_sep)
    })

    function addUnuDiag(initialvalue = null, initialname = null, initialcat = null) {
        iUnuDiag++;
        $("#ekbodyDiagUnu")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekunuDiag' + iUnuDiag + '" class="form-control" name="unuDiag[]" ></select></div>')
                )
                .append($('<td>')
                    .append($('<select class="form-control">')
                        .attr('name', 'unuDiagCat[]').attr('id', 'unuDiagCat' + iUnuDiag) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                    )
                )
            )

        initializeDiagSelect2("ekunuDiag" + iUnuDiag, initialvalue, initialname)
        $("#unuDiagCat" + iUnuDiag).val(initialcat);
    }

    function addUnuProc(initialvalue = null, initialname = null, initialcat = null) {
        iUnuProc++;
        $("#ekbodyProcUnu")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekunuProc' + iUnuProc + '" class="form-control" name="unuProc[]" ></select></div>')
                )
            )

        initializeProcSelect2("ekunuProc" + iUnuProc, initialvalue, initialname)
    }

    function addInaDiag(initialvalue = null, initialname = null, initialcat = null) {
        iInaDiag++;
        $("#ekbodyDiagIna")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekinaDiag' + iInaDiag + '" class="form-control" name="inaDiag[]" ></select></div>')
                )
                .append($('<td>')
                    .append($('<select class="form-control">')
                        .attr('name', 'inaDiagCat[]').attr('id', 'inaDiagCat' + iInaDiag) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                    )
                )
            )

        initializeDiagSelect2("ekinaDiag" + iInaDiag, initialvalue, initialname)
        $("#inaDiagCat" + iInaDiag).val(initialcat);
    }

    function addInaProc(initialvalue = null, initialname = null, initialcat = null) {
        iInaProc++;
        $("#ekbodyProcIna")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekinaProc' + iInaProc + '" class="form-control" name="inaProc[]" ></select></div>')
                )
            )

        initializeProcSelect2("ekinaProc" + iInaProc, initialvalue, initialname)
    }

    function setEklaimData() {
        if (currentStep < 3) {
            $("#ekfinalklaimbtn").hide()
        } else {
            $("#ekfinalklaimbtn").show()
        }

        $("#ekcurrentStep").val(currentStep)
        $("#ektrans_id").val(ektrans_id)
        $("#ekvisit_id").val(ekvisit_id)
        $("#eknosep").val(eknosep)
        $("#eknosep_inap").val(eknosep_inap)
        $("#eknama_pasien").val(eknama_pasien)
        $("#ekgender").val(ekgender)
        $("#eknomor_rm").val(eknomor_rm)
        $("#ektgl_lahir").val(ektgl_lahir)
        $("#eknama_dokter").val(eknama_dokter)


        $("#eknomor_kartu").val(eknomor_kartu)
        $("#eknomor_sep").val(eknomor_sep)
        $("#ekpayor_id").val(ekpayor_id)
        $("#ekpayor_cd").val(ekpayor_cd)
        $("#payor").val(ekpayor_id + '-' + ekpayor_cd)
        $("#ekcob_cd").val(ekcob_cd)
        $("#ekkode_tarif").val(ekkode_tarif)

        $("#ekjenis_rawat").val(ekjenis_rawat)
        $("#ekkelas_rawat").val(ekkelas_rawat)
        $("#ektgl_masuk").val(ektgl_masuk)
        $("#ektgl_pulang").val(ektgl_pulang)
        $("#ekcara_masuk").val(ekcara_masuk)
        $("#ekdischarge_status").val(ekdischarge_status)
        $("#ekcoder_nik").val(ekcoder_nik)
        $("#ektension_upper").val(ektension_upper)
        $("#ektension_below").val(ektension_below)
        $("#ekadl_sub_acute").val(ekadl_sub_acute)
        $("#ekadl_chronic").val(ekadl_chronic)
        $("#ekdializer_single_use").val(ekdializer_single_use)
        $("#ekkantong_darah").val(ekkantong_darah)
        $("input[name=upgrade_class_ind][value=" + ekupgrade_class_ind + "]").prop('checked', true);
        if (ekupgrade_class_ind == '1') {
            $(".upgradeClassParam").show()
        } else {
            $(".upgradeClassParam").hide()
        }
        $("#ekupgrade_class_class").val(ekupgrade_class_class)
        $("#ekupgrade_class_los").val(ekupgrade_class_los)
        $("#ekadd_payment_pct").val(ekadd_payment_pct)
        $("#ekupgrade_class_payor").val(ekupgrade_class_payor)

        $("#ekicu_indikator").val(ekicu_indikator)
        $("#ekicu_los").val(ekicu_los)
        $("#ekventilator_hour").val(ekventilator_hour)
        $("#ekuse_ind").val(ekuse_ind)
        $("#ekstart_dttm").val(ekstart_dttm)
        $("#ekstop_dttm").val(ekstop_dttm)
        $("#ekbirth_weight").val(ekbirth_weight)

        // $("input[name=apgar][value=" + ekapgar + "]").prop('checked', true);
        // $("#ekmnt1appearance").val(ekapgar[0].appearance)
        // $("#ekmnt1pulse").val(ekapgar[0].pulse)
        // $("#ekmnt1grimace").val(ekapgar[0].grimace)
        // $("#ekmnt1activity").val(ekapgar[0].activity)
        // $("#ekmnt1respiration").val(ekapgar[0].respiration)
        // $("#ekmnt5appearance").val(ekapgar[1].appearance)
        // $("#ekmnt5pulse").val(ekapgar[1].pulse)
        // $("#ekmnt5grimace").val(ekapgar[1].grimace)
        // $("#ekmnt5activity").val(ekapgar[1].activity)
        // $("#ekmnt5respiration").val(ekapgar[1].respiration)

        // $("input[name=persalinan][value=" + ekpersalinan + "]").prop('checked', true);
        $("#ekusia_kehamilan").val(ekusia_kehamilan)
        $("#ekonset_kontraksi").val(ekonset_kontraksi)
        $("#ekgravida").val(ekgravida)
        $("#ekpartus").val(ekpartus)
        $("#ekabortus").val(ekabortus)
        $("#ekdelivery_sequence").val('')
        $("#ekdelivery_method").val('')
        $("#ekuse_manual").val('')
        $("#ekuse_forcep").val('')
        $("#ekuse_vacuum").val('')
        $("#ekletak_janin").val('')
        $("#ekkondisi").val('')

        $('#ektarif_poli_eks').val(ektarif_poli_eks)

        // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
        $("#ekcovid19_status_cd").val(ekcovid19_status_cd)
        $("#eknomor_kartu_t").val(eknomor_kartu_t)
        $("#ekcovid19_no_sep").val(ekcovid19_no_sep)
        $("#ekterapi_konvalesen").val(ekterapi_konvalesen)
        $("#ekisoman_ind").val(ekisoman_ind)
        $("#ekbayi_lahir_status_cd").val(ekbayi_lahir_status_cd)
        $("#ekcovid19_rs_darurat_ind").val(ekcovid19_rs_darurat_ind)
        $("#ekcovid19_cc_ind").val(ekcovid19_cc_ind)
        $("#ekcovid19_co_insidense_ind").val(ekcovid19_co_insidense_ind)
        $("#ekepisodes7").val(ekepisodes7)
        $("#ekepisodes8").val(ekepisodes8)
        $("#ekepisodes9").val(ekepisodes9)
        $("#ekepisodes10").val(ekepisodes10)
        $("#ekepisodes11").val(ekepisodes11)
        $("#ekepisodes12").val(ekepisodes12)
        $("#eklab_asam_laktat").val(eklab_asam_laktat)
        $("#eklab_d_dimer").val(eklab_d_dimer)
        $("#eklab_anti_hiv").val(eklab_anti_hiv)
        $("#eklab_procalcitonin").val(eklab_procalcitonin)
        $("#eklab_analisa_gas").val(eklab_analisa_gas)
        $("#eklab_crp").val(eklab_crp)
        $("#eklab_aptt").val(eklab_aptt)
        $("#eklab_pt").val(eklab_pt)
        $("#eklab_albumin").val(eklab_albumin)
        $("#eklab_kultur").val(eklab_kultur)
        $("#eklab_waktu_pendarahan").val(eklab_waktu_pendarahan)
        $("#ekrad_thorax_ap_pa").val(ekrad_thorax_ap_pa)
        $("#ekpemulasaraan_jenazah").val(ekpemulasaraan_jenazah)
        $("#ekkantong_jenazah").val(ekkantong_jenazah)
        $("#ekpeti_jenazah").val(ekpeti_jenazah)
        $("#ekplastik_erat").val(ekplastik_erat)
        $("#ekdesinfektan_jenazah").val(ekdesinfektan_jenazah)
        $("#ekmobil_jenazah").val(ekmobil_jenazah)
        $("#ekdesinfektan_mobil_jenazah").val(ekdesinfektan_mobil_jenazah)

        $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
        $("#ekprosedur_bedah").val((ekprosedur_bedah))
        $("#ekkonsultasi").val((ekkonsultasi))
        $("#ektenaga_ahli").val((ektenaga_ahli))
        $("#ekkeperawatan").val((ekkeperawatan))
        $("#ekpenunjang").val((ekpenunjang))
        $("#ekradiologi").val((ekradiologi))
        $("#eklaboratorium").val((eklaboratorium))
        $("#ekpelayanan_darah").val((ekpelayanan_darah))
        $("#ekrehabilitasi").val((ekrehabilitasi))
        $("#ekkamar").val((ekkamar))
        $("#ekrawat_intensif").val((ekrawat_intensif))
        $("#ekobat").val((ekobat))
        $("#ekobat_kronis").val((ekobat_kronis))
        $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
        $("#ekalkes").val((ekalkes))
        $("#ekbmhp").val((ekbmhp))
        $("#eksewa_alat").val((eksewa_alat))
        $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))


    }

    function setEklaimData() {

        $("#ekcurrentStep").val(currentStep)
        $("#ektrans_id").val(ektrans_id)
        $("#ekvisit_id").val(ekvisit_id)
        $("#eknosep").val(eknosep)
        $("#eknosep_inap").val(eknosep_inap)
        $("#eknama_pasien").val(eknama_pasien)
        $("#ekgender").val(ekgender)
        $("#eknomor_rm").val(eknomor_rm)
        $("#ektgl_lahir").val(ektgl_lahir)
        $("#eknama_dokter").val(eknama_dokter)


        $("#eknomor_kartu").val(eknomor_kartu)
        $("#eknomor_sep").val(eknomor_sep)
        $("#ekpayor_id").val(ekpayor_id)
        $("#ekpayor_cd").val(ekpayor_cd)
        $("#payor").val(ekpayor_id + '-' + ekpayor_cd)
        $("#ekcob_cd").val(ekcob_cd)
        $("#ekkode_tarif").val(ekkode_tarif)

        $("#ekjenis_rawat").val(ekjenis_rawat)
        $("#ekkelas_rawat").val(ekkelas_rawat)
        $("#ektgl_masuk").val(ektgl_masuk)
        $("#ektgl_pulang").val(ektgl_pulang)
        $("#ekcara_masuk").val(ekcara_masuk)
        $("#ekdischarge_status").val(ekdischarge_status)
        $("#ekcoder_nik").val(ekcoder_nik)
        $("#ektension_upper").val(ektension_upper)
        $("#ektension_below").val(ektension_below)
        $("#ekadl_sub_acute").val(ekadl_sub_acute)
        $("#ekadl_chronic").val(ekadl_chronic)
        $("#ekdializer_single_use").val(ekdializer_single_use)
        $("#ekkantong_darah").val(ekkantong_darah)
        $("input[name=upgrade_class_ind][value=" + ekupgrade_class_ind + "]").prop('checked', true);
        if (ekupgrade_class_ind == '1') {
            $(".upgradeClassParam").show()
        } else {
            $(".upgradeClassParam").hide()
        }
        $("#ekupgrade_class_class").val(ekupgrade_class_class)
        $("#ekupgrade_class_los").val(ekupgrade_class_los)
        $("#ekadd_payment_pct").val(ekadd_payment_pct)
        $("#ekupgrade_class_payor").val(ekupgrade_class_payor)

        $("#ekicu_indikator").val(ekicu_indikator)
        $("#ekicu_los").val(ekicu_los)
        $("#ekventilator_hour").val(ekventilator_hour)
        $("#ekuse_ind").val(ekuse_ind)
        $("#ekstart_dttm").val(ekstart_dttm)
        $("#ekstop_dttm").val(ekstop_dttm)
        $("#ekbirth_weight").val(ekbirth_weight)

        // $("input[name=apgar][value=" + ekapgar + "]").prop('checked', true);
        // $("#ekmnt1appearance").val(ekapgar[0].appearance)
        // $("#ekmnt1pulse").val(ekapgar[0].pulse)
        // $("#ekmnt1grimace").val(ekapgar[0].grimace)
        // $("#ekmnt1activity").val(ekapgar[0].activity)
        // $("#ekmnt1respiration").val(ekapgar[0].respiration)
        // $("#ekmnt5appearance").val(ekapgar[1].appearance)
        // $("#ekmnt5pulse").val(ekapgar[1].pulse)
        // $("#ekmnt5grimace").val(ekapgar[1].grimace)
        // $("#ekmnt5activity").val(ekapgar[1].activity)
        // $("#ekmnt5respiration").val(ekapgar[1].respiration)

        // $("input[name=persalinan][value=" + ekpersalinan + "]").prop('checked', true);
        $("#ekusia_kehamilan").val(ekusia_kehamilan)
        $("#ekonset_kontraksi").val(ekonset_kontraksi)
        $("#ekgravida").val(ekgravida)
        $("#ekpartus").val(ekpartus)
        $("#ekabortus").val(ekabortus)
        $("#ekdelivery_sequence").val('')
        $("#ekdelivery_method").val('')
        $("#ekuse_manual").val('')
        $("#ekuse_forcep").val('')
        $("#ekuse_vacuum").val('')
        $("#ekletak_janin").val('')
        $("#ekkondisi").val('')

        $('#ektarif_poli_eks').val(ektarif_poli_eks)

        // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
        $("#ekcovid19_status_cd").val(ekcovid19_status_cd)
        $("#eknomor_kartu_t").val(eknomor_kartu_t)
        $("#ekcovid19_no_sep").val(ekcovid19_no_sep)
        $("#ekterapi_konvalesen").val(ekterapi_konvalesen)
        $("#ekisoman_ind").val(ekisoman_ind)
        $("#ekbayi_lahir_status_cd").val(ekbayi_lahir_status_cd)
        $("#ekcovid19_rs_darurat_ind").val(ekcovid19_rs_darurat_ind)
        $("#ekcovid19_cc_ind").val(ekcovid19_cc_ind)
        $("#ekcovid19_co_insidense_ind").val(ekcovid19_co_insidense_ind)
        $("#ekepisodes7").val(ekepisodes7)
        $("#ekepisodes8").val(ekepisodes8)
        $("#ekepisodes9").val(ekepisodes9)
        $("#ekepisodes10").val(ekepisodes10)
        $("#ekepisodes11").val(ekepisodes11)
        $("#ekepisodes12").val(ekepisodes12)
        $("#eklab_asam_laktat").val(eklab_asam_laktat)
        $("#eklab_d_dimer").val(eklab_d_dimer)
        $("#eklab_anti_hiv").val(eklab_anti_hiv)
        $("#eklab_procalcitonin").val(eklab_procalcitonin)
        $("#eklab_analisa_gas").val(eklab_analisa_gas)
        $("#eklab_crp").val(eklab_crp)
        $("#eklab_aptt").val(eklab_aptt)
        $("#eklab_pt").val(eklab_pt)
        $("#eklab_albumin").val(eklab_albumin)
        $("#eklab_kultur").val(eklab_kultur)
        $("#eklab_waktu_pendarahan").val(eklab_waktu_pendarahan)
        $("#ekrad_thorax_ap_pa").val(ekrad_thorax_ap_pa)
        $("#ekpemulasaraan_jenazah").val(ekpemulasaraan_jenazah)
        $("#ekkantong_jenazah").val(ekkantong_jenazah)
        $("#ekpeti_jenazah").val(ekpeti_jenazah)
        $("#ekplastik_erat").val(ekplastik_erat)
        $("#ekdesinfektan_jenazah").val(ekdesinfektan_jenazah)
        $("#ekmobil_jenazah").val(ekmobil_jenazah)
        $("#ekdesinfektan_mobil_jenazah").val(ekdesinfektan_mobil_jenazah)

        $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
        $("#ekprosedur_bedah").val((ekprosedur_bedah))
        $("#ekkonsultasi").val((ekkonsultasi))
        $("#ektenaga_ahli").val((ektenaga_ahli))
        $("#ekkeperawatan").val((ekkeperawatan))
        $("#ekpenunjang").val((ekpenunjang))
        $("#ekradiologi").val((ekradiologi))
        $("#eklaboratorium").val((eklaboratorium))
        $("#ekpelayanan_darah").val((ekpelayanan_darah))
        $("#ekrehabilitasi").val((ekrehabilitasi))
        $("#ekkamar").val((ekkamar))
        $("#ekrawat_intensif").val((ekrawat_intensif))
        $("#ekobat").val((ekobat))
        $("#ekobat_kronis").val((ekobat_kronis))
        $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
        $("#ekalkes").val((ekalkes))
        $("#ekbmhp").val((ekbmhp))
        $("#eksewa_alat").val((eksewa_alat))
        $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))


    }

    function setEnableEklaim(bool) {

        $('#formeklaim input').attr('disabled', bool);
        $('#formeklaim textarea').attr('disabled', bool);
        $('#formeklaim select').attr('disabled', bool);


    }

    var grouperResp;

    function getEklaimData(nosep_klaim) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getEklaimData',
            type: "POST",
            data: JSON.stringify({
                'nosep_klaim': nosep_klaim
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.nosep_klaim != '' && typeof data.nosep_klaim !== 'undefined') {
                    ekklaim_final = data.klaim_status
                    eknosep = data.nosep
                    eknosep_inap = data.nosep_inap
                    eknomor_kartu = data.nokartu
                    eknomor_sep = data.nosep_klaim
                    eknomor_rm = data.nomr
                    eknama_pasien = data.namapasien
                    ekgender = data.gender
                    ektgl_lahir = data.tgllahir
                    ekpayor_id = data.payor_id
                    ekpayor_cd = data.payor_cd
                    ekcob_cd = data.cob_cd

                    ekjenis_rawat = data.jnsrawat
                    ektgl_masuk = (data.tgl_masuk)
                    ektgl_masuk = ektgl_masuk.substring(0, 16)
                    ektgl_pulang = data.tgl_keluar
                    ektgl_pulang = ektgl_pulang.substring(0, 16)
                    ekcara_masuk = data.cara_masuk
                    ekdischarge_status = eklaimCaraKeluar[data.discharge_status]
                    ekcoder_nik = data.coder_nik
                    eknama_dokter = data.dokter
                    ektarif_poli_eks = data.tarif_poli_eks
                    ekkode_tarif = data.kodetarif
                    ektension_upper = $("#aetension_upper").val()
                    ektension_below = $("#aetension_below").val()
                    ekadl_sub_acute = data.adl_sub_acute
                    ekadl_chronic = data.adl_chronic
                    ekdializer_single_use = data.dializer_single_use
                    ekkantong_darah = data.kantong_darah
                    ekkelas_rawat = data.klsrawat
                    ekbirth_weight = data.birthweight

                    ekupgrade_class_ind = data.upgrade_class_id
                    ekupgrade_class_class = data.upgrade_class_class
                    ekupgrade_class_los = data.upgrade_class_los
                    ekadd_payment_pct = data.add_payment_pct
                    ekupgrade_class_payor = data.upgrade_class_payor

                    ekicu_indikator = data.icu_indikator
                    ekicu_los = data.icu_los
                    ekventilator_hour = data.ventilator_hour
                    // ekuse_ind = ''
                    // ekstart_dttm = ''
                    // ekstop_dttm = ''

                    // ekapgar = ''
                    // ekappearance = ''
                    // ekpulse = ''
                    // ekgrimace = ''
                    // ekactivity = ''
                    // ekrespiration = ''

                    // ekpersalinan = ''
                    // ekusia_kehamilan = ''
                    // ekonset_kontraksi = ''
                    // ekgravida = ''
                    // ekpartus = ''
                    // ekabortus = ''
                    // ekdelivery_method = ''
                    // ekuse_manual = ''
                    // ekuse_forcep = ''
                    // ekuse_vacuum = ''
                    // ekletak_janin = ''
                    // ekkondisi = ''

                    // ekcovid_indicator = ''
                    // ekcovid19_status_cd = ''
                    // ekcovid19_no_sep = ''
                    // eknomor_kartu_t = ''
                    // ekterapi_konvalesen = ''
                    // ekisoman_ind = ''
                    // ekbayi_lahir_status_cd = ''
                    // ekcovid19_rs_darurat_ind = ''
                    // ekcovid19_cc_ind = ''
                    // ekcovid19_co_insidense_ind = ''
                    // ekepisodes7 = ''
                    // ekepisodes8 = ''
                    // ekepisodes9 = ''
                    // ekepisodes10 = ''
                    // ekepisodes11 = ''
                    // ekepisodes12 = ''
                    // eklab_asam_laktat = ''
                    // eklab_d_dimer = ''
                    // eklab_anti_hiv = ''
                    // eklab_procalcitonin = ''
                    // eklab_analisa_gas = ''
                    // eklab_crp = ''
                    // eklab_pt = '';
                    // eklab_aptt = ''
                    // eklab_albumin = ''
                    // eklab_kultur = ''
                    // eklab_waktu_pendarahan = ''
                    // ekrad_thorax_ap_pa = ''
                    // ekpemulasaraan_jenazah = ''
                    // ekkantong_jenazah = ''
                    // ekpeti_jenazah = ''
                    // ekplastik_erat = ''
                    // ekdesinfektan_jenazah = ''
                    // ekmobil_jenazah = ''
                    // ekdesinfektan_mobil_jenazah = ''


                    ekprosedur_non_bedah = parseFloat(data.proc_nonbedah)
                    ekprosedur_bedah = parseFloat(data.proc_bedah)
                    ekkonsultasi = parseFloat(data.konsultasi)
                    ektenaga_ahli = parseFloat(data.tenaga_ahli)
                    ekkeperawatan = parseFloat(data.keperawatan)
                    ekpenunjang = parseFloat(data.penunjang)
                    ekradiologi = parseFloat(data.radiologi)
                    eklaboratorium = parseFloat(data.laboratorium)
                    ekpelayanan_darah = parseFloat(data.pelayanandarah)
                    ekrehabilitasi = parseFloat(data.rehabilitasi)
                    ekkamar = parseFloat(data.kamar)
                    ekrawat_intensif = parseFloat(data.rawat_intensif)
                    ekobat = parseFloat(data.obat)
                    ekobat_kronis = parseFloat(data.obatkronis)
                    ekobat_kemoterapi = parseFloat(data.obatkemoterapi)
                    ekalkes = parseFloat(data.alkes)
                    ekbmhp = parseFloat(data.bmhp)
                    eksewa_alat = parseFloat(data.sewa_alat)

                    ektotalBillEklaim =
                        ekprosedur_non_bedah +
                        ekprosedur_bedah +
                        ekkonsultasi +
                        ektenaga_ahli +
                        ekkeperawatan +
                        ekpenunjang +
                        ekradiologi +
                        eklaboratorium +
                        ekpelayanan_darah +
                        ekrehabilitasi +
                        ekkamar +
                        ekrawat_intensif +
                        ekobat +
                        ekobat_kronis +
                        ekobat_kemoterapi +
                        ekalkes +
                        ekbmhp +
                        eksewa_alat;

                    if (ektotalBillEklaim == 0.0) {
                        getBillEklaim18('<?= $visit['trans_id']; ?>')
                    }

                    var respon01 = JSON.parse(data.respon_01)
                    var respon02 = JSON.parse(data.respon_02)
                    var respon03 = JSON.parse(data.respon_03)

                    if (typeof respon01 !== 'undefined') {
                        if (respon01.metadata.code == 200) {
                            currentStep = 1
                            if (typeof respon02 !== 'undefined') {
                                if (respon02.metadata.code == 200) {
                                    currentStep = 2
                                    if (typeof respon03 !== 'undefined') {
                                        if (respon03.metadata.code == 200) {
                                            currentStep = 3

                                        }
                                    }
                                }
                            }
                        }
                    }



                    grouperResp = JSON.parse(data.respon_03)


                    setGrouperResult(grouperResp)
                    if (currentStep == 3) {
                        $("#ekfinalklaimbtn").show()
                    }
                    if (currentStep < 3) {
                        $("#ekfinalklaimbtn").hide()
                    }
                    if (ekklaim_final > 1) {
                        $("#ekformsubmit").hide()
                        $("#ekfinalklaimbtn").hide()
                        $("#ekeditbtn").show()
                        setEnableEklaim(true)
                    }
                    setEklaimData()

                } else {
                    if (ektotalBillEklaim == 0.0) {
                        getBillEklaim18('<?= $visit['trans_id']; ?>')
                    }
                    setEklaimData()
                }



            },
            error: function() {

            }
        });
    }

    function getBillEklaim18(trans) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getBillEklaim18',
            type: "POST",
            data: JSON.stringify({
                'trans': trans
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                ekprosedur_non_bedah = parseFloat(data.prosedur_non_bedah)
                ekprosedur_bedah = parseFloat(data.prosedur_bedah)
                ekkonsultasi = parseFloat(data.konsultasi)
                ektenaga_ahli = parseFloat(data.tenaga_ahli)
                ekkeperawatan = parseFloat(data.keperawatan)
                ekpenunjang = parseFloat(data.penunjang)
                ekradiologi = parseFloat(data.radiologi)
                eklaboratorium = parseFloat(data.laboratorium)
                ekpelayanan_darah = parseFloat(data.pelayanan_darah)
                ekrehabilitasi = parseFloat(data.rehabilitasi)
                ekkamar = parseFloat(data.kamar)
                ekrawat_intensif = parseFloat(data.rawat_intensif)
                ekobat = parseFloat(data.obat)
                ekobat_kronis = parseFloat(data.obat_kronis)
                ekobat_kemoterapi = parseFloat(data.obat_kemoterapi)
                ekalkes = parseFloat(data.alkes)
                ekbmhp = parseFloat(data.bmhp)
                eksewa_alat = parseFloat(data.sewa_alat)

                ektotalBillEklaim = ekprosedur_non_bedah +
                    ekprosedur_bedah +
                    ekkonsultasi +
                    ektenaga_ahli +
                    ekkeperawatan +
                    ekpenunjang +
                    ekradiologi +
                    eklaboratorium +
                    ekpelayanan_darah +
                    ekrehabilitasi +
                    ekkamar +
                    ekrawat_intensif +
                    ekobat +
                    ekobat_kronis +
                    ekobat_kemoterapi +
                    ekalkes +
                    ekbmhp +
                    eksewa_alat;


                $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
                $("#ekprosedur_bedah").val((ekprosedur_bedah))
                $("#ekkonsultasi").val((ekkonsultasi))
                $("#ektenaga_ahli").val((ektenaga_ahli))
                $("#ekkeperawatan").val((ekkeperawatan))
                $("#ekpenunjang").val((ekpenunjang))
                $("#ekradiologi").val((ekradiologi))
                $("#eklaboratorium").val((eklaboratorium))
                $("#ekpelayanan_darah").val((ekpelayanan_darah))
                $("#ekrehabilitasi").val((ekrehabilitasi))
                $("#ekkamar").val((ekkamar))
                $("#ekrawat_intensif").val((ekrawat_intensif))
                $("#ekobat").val((ekobat))
                $("#ekobat_kronis").val((ekobat_kronis))
                $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
                $("#ekalkes").val((ekalkes))
                $("#ekbmhp").val((ekbmhp))
                $("#eksewa_alat").val((eksewa_alat))
                $("#ektgl_lahir").val(data.date_of_birth)

                $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))

            },
            error: function() {

            }
        });
    }

    function setGrouperResult(data) {
        if (data.metadata.code == 200) {
            var response = data.response
            var cbg = response.cbg
            var totalIna = 0.0
            if (typeof cbg !== 'undefined') {
                $("#cbgdescription").html(cbg.description)
                $("#cbgcode").html(cbg.code)
                $("#cbgtariff").html(formatCurrency(parseFloat(cbg.tariff)))
                if (typeof cbg.base_tariff !== 'undefined') {
                    $("#cbgtariff").html(formatCurrency(parseFloat(cbg.base_tariff)))
                    totalIna += parseFloat(cbg.base_tariff)
                } else
                    totalIna += parseFloat(cbg.tariff)
            }
            var sub_acute = response.sub_acute
            if (typeof sub_acute !== 'undefined') {
                $("#sub_acutedescription").html(sub_acute.description)
                $("#sub_acutecode").html(sub_acute.code)
                $("#sub_acutetariff").html(formatCurrency(parseFloat(sub_acute.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var chronic = response.chronic
            if (typeof chronic !== 'undefined') {
                $("#chronicdescription").html(chronic.description)
                $("#chroniccode").html(chronic.code)
                $("#chronictariff").html(formatCurrency(parseFloat(chronic.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var special_cmg_option = data.special_cmg_option
            special_cmg_option.forEach((element, key) => {
                var code = special_cmg_option[key].code
                var description = special_cmg_option[key].description
                var type = special_cmg_option[key].type
                type = type.replace(/\s+/g, '_').toLowerCase();
                $("#" + type + "description").append($("<option>").attr("value", code).html(description).attr("onclick", 'postGrouper2("' + type + '","' + code + '")'))
                $("#" + type + "description").prop("disabled", false)
            });
            var special_cmg_result = data.response.special_cmg
            if (typeof special_cmg_result !== 'undefined') {
                special_cmg_result.forEach((element, key) => {
                    var code = special_cmg_result[key].code
                    var description = special_cmg_result[key].description
                    var type = special_cmg_result[key].type
                    var tariff = special_cmg_result[key].tariff
                    type = type.replace(/\s+/g, '_').toLowerCase();
                    $("#" + type + "description").find('option[text="' + description + '"]').val();
                    $("#" + type + "tariff").html(formatCurrency(parseFloat(tariff)))
                    $("#" + type + "code").html(code)
                    totalIna += parseFloat(tariff)

                });
            }

            $("#totalGrouper").html(formatCurrency(totalIna))

        } else {
            errorMsg(data.metadata.message);
        }
    }
    var eklaimhasil;
    $("#formeklaim").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postEklaim',
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
                setGrouperResult(data)
                if (currentStep < 3) {
                    $("#ekfinalklaimbtn").hide()
                } else {
                    $("#ekfinalklaimbtn").show()
                }
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

    function postGrouper2(type, code) {
        $("#" + type + "code").html(code)

        var collectCode = '';
        var specialProcedure = $("#special_proceduredescription").val()
        var specialProsthesis = $("#special_prosthesisdescription").val()
        var specialInvestigation = $("#special_investigationdescription").val()
        var specialDrug = $("#special_drugdescription").val()

        if (specialProcedure != '-' && specialProcedure != '') {
            collectCode += specialProcedure + "#"
        }
        if (specialProsthesis != '-' && specialProsthesis != '') {
            collectCode += specialProsthesis + "#"
        }
        if (specialInvestigation != '-' && specialInvestigation != '') {
            collectCode += specialInvestigation + "#"
        }
        if (specialDrug != '-' && specialDrug != '') {
            collectCode += specialDrug + "#"
        }
        collectCode = collectCode.substring(0, collectCode.length - 1)
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postGrouper2',
            type: "POST",
            data: JSON.stringify({
                'type': type,
                'code': collectCode,
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#ekformsubmit").button('loading')
            },
            success: function(data) {
                setGrouperResult(data)
                $("#ekformsubmit").button('reset')
            },
            error: function() {
                $("#ekformsubmit").button('reset')
            }
        });
    }

    function finalKlaim() {
        $("#ekfinalklaimbtn").button('loading')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/finalKlaim',
            type: "POST",
            data: JSON.stringify({
                'coder_nik': ekcoder_nik,
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#ekfinalklaimbtn").button('loading')
            },
            success: function(data) {
                if (data.metadata.code == 200) {
                    $("#ekeditbtn").show()
                    $("#ekfinalklaimbtn").hide()
                    $("#ekformsubmit").hide()

                    setEnableEklaim(true)
                }
            },
            error: function() {

            },
            complete: function() {
                $("#ekfinalklaimbtn").button('reset')
            }
        });
    }

    function editKlaim() {
        $("#ekeditbtn").button('loading')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editKlaim',
            type: "POST",
            data: JSON.stringify({
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == 200) {
                    $("#ekeditbtn").hide()
                    $("#ekfinalklaimbtn").show()
                    $("#ekformsubmit").show()
                    setEnableEklaim(false)
                }
                $("#ekeditbtn").button('reset')

            },
            error: function() {

            }
        });
    }
</script>