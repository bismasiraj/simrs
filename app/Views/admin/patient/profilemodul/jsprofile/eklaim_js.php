<script type="text/javascript">
    function showHideEklaim(param, showhide) {
        if (showhide == 1) {
            $("." + param).slideDown()
        } else if (showhide == 0) {
            $("." + param).slideUp()
        }
    }
    $(".upgradeClassParam").slideUp()
    $(".icuParam").slideUp()
    $(".apgarParam").slideUp()
    $(".persalinanParam").slideUp()
    $(".covidParam").slideUp()
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

    var ektrans_id = visit?.trans_id
    var ekvisit_id = visit?.visit_id
    var eknosep = visit?.no_skp
    var eknosep_inap = visit?.no_skpinap
    var eknomor_kartu = '<?= $visit['pasien_id']; ?>'
    var eknomor_sep = '<?= is_null($visit['no_skpinap']) || $visit['no_skpinap'] == '' ? $visit['no_skp'] : $visit['no_skpinap']; ?>'
    var eknomor_rm = visit?.no_registration
    var eknama_pasien = visit?.diantar_oleh
    var ekgender = visit?.gender
    var ektgl_lahir = visit?.tgl_lahir
    var ekpayor_id = '3'
    var ekpayor_cd = 'JKN'
    var ekcob_cd = '-'

    var ekjenis_rawat = eknomor_sep == eknosep ? 2 : 1
    var ektgl_masuk = visit?.visit_datetime
    var ektgl_pulang = visit?.exit_date == '' ? visit?.visit_datetime : visit?.exit_date
    var ekcara_masuk = visit?.clinic_id == 'P012' ? 'emd' : (visit?.asalrujukan == '1') ? 'gp' : 'hosp-trans'
    var ekdischarge_status = eklaimCaraKeluar[visit?.keluar_id]
    <?php $empl = user()->getEmployeeData() ?>
    var ekcoder_nik = '1771051804810003' //'<?= isset($empl['npk']) ? $empl['npk'] : ''; ?>'
    var eknama_dokter = visit?.fullname_inap == null || visit?.fullname_inap == '' ? visit?.fullname : visit?.fullname_inap
    var ektarif_poli_eks = 10000
    var ekkode_tarif = 'DS'
    var ektension_upper = 0
    var ektension_below = 0
    var ekadl_sub_acute = ''
    var ekadl_chronic = ''
    var ekdializer_single_use = ''
    var ekkantong_darah = ''
    var ekkelas_rawat = visit?.class_room_id == null || visit?.class_room_id == '' ? (visit?.kdpoli_eks == '0' ? 3 : 1) : (parseInt(visit?.class_id_plafond) - 1)
    var ekbirth_weight = 0;

    var class_id_eval = visit?.class_id === '10' ? visit?.class_id_plafond : visit?.class_id;

    var ekupgrade_class_ind = ['2', '3'].includes(visit?.class_id_plafond) && ['3', '4'].includes(class_id_eval) &&
        ((class_id_eval > visit?.class_id_plafond ? visit?.class_id_plafond : class_id_eval) != visit?.class_id_plafond) ?
        '1' :
        '0';
    const classMap = {
        '3': 'kelas_2',
        '2': 'kelas_1',
        '6': 'vip',
        '11': 'vip'
    };
    var ekupgrade_class_class = classMap[visit?.class_id] || '';
    var ekupgrade_class_los = ''
    var ekadd_payment_pct = '75'
    var ekupgrade_class_payor = 'peserta'

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

    //param persalinan
    var ekpersalinan = 0
    var ekusia_kehamilan = ''
    var ekonset_kontraksi = ''
    var ekgravida = ''
    var ekpartus = ''
    var ekabortus = ''
    var ekdelivery = []


    //param covid
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
    $("#eklaimTab").on("click", function() {
        getLastCppt()
        getEklaimData(eknomor_sep)
    })
</script>

<script type="text/javascript">
    $(document).ready(function(e) {
        setInitialEklaimData()
    })
    const getLastCppt = () => {
        postData({
            visit_id: visit?.visit_id
        }, 'admin/eklaimcontroller/getLastCppt', (res) => {
            console.log(res)
            console.log(res.data)
            console.log(res.data.exam)
            if (res.data.exam) {
                let exam = res.data.exam
                ektension_upper = exam?.tension_upper
                ektension_below = exam?.tension_below
                $("#ektension_upper").val(ektension_upper)
                $("#ektension_below").val(ektension_below)
            }
        })
    }

    function enableEklaim() {
        $("#formeklaim").find("input, textarea, select").prop("disabled", false)
    }

    function disableEklaim() {
        $("#formeklaim").find("input, textarea, select").prop("disabled", true)
    }

    function setInitialEklaimData() {
        $(".upgradeClassParam").slideUp()
        $(".icuParam").slideUp()
        $(".apgarParam").slideUp()
        $(".persalinanParam").slideUp()
        $(".covidParam").slideUp()
        iUnuDiag = 0;
        iUnuProc = 0;
        iInaDiag = 0;
        iInaProc = 0;
        currentStep = 0;
        ekklaim_final = 0;

        ektrans_id = visit?.trans_id
        ekvisit_id = visit?.visit_id
        eknosep = visit?.no_skp
        eknosep_inap = visit?.no_skpinap
        eknomor_kartu = '<?= $visit['pasien_id']; ?>'
        eknomor_sep = '<?= is_null($visit['no_skpinap']) || $visit['no_skpinap'] == '' ? $visit['no_skp'] : $visit['no_skpinap']; ?>'
        eknomor_rm = visit?.no_registration
        eknama_pasien = visit?.diantar_oleh
        ekgender = visit?.gender
        ektgl_lahir = visit?.tgl_lahir
        ekpayor_id = '3'
        ekpayor_cd = 'JKN'
        ekcob_cd = '-'

        ekjenis_rawat = eknomor_sep == eknosep ? 2 : 1
        ektgl_masuk = visit?.visit_datetime
        ektgl_masuk = ektgl_masuk.substring(0, 16)
        ektgl_pulang = visit?.exit_date == '' ? ektgl_masuk : visit?.exit_date
        ekcara_masuk = visit?.clinic_id == 'P012' ? 'emd' : (visit?.asalrujukan == '1') ? 'gp' : 'hosp-trans'
        ekdischarge_status = eklaimCaraKeluar[visit?.keluar_id]
        ekdischarge_status = ekdischarge_status ?? '1';
        <?php $empl = user()->getEmployeeData() ?>
        ekcoder_nik = '1771051804810003' //'<?= isset($empl['npk']) ? $empl['npk'] : ''; ?>'
        eknama_dokter = visit?.fullname_inap == null || visit?.fullname_inap == '' ? visit?.fullname : visit?.fullname_inap
        ektarif_poli_eks = 10000
        ekkode_tarif = 'DS'
        ektension_upper = 0
        ektension_below = 0
        ekadl_sub_acute = ''
        ekadl_chronic = ''
        ekdializer_single_use = ''
        ekkantong_darah = ''
        ekkelas_rawat = visit?.class_room_id == null || visit?.class_room_id == '' ? (visit?.kdpoli_eks == '0' ? 3 : 1) : (visit?.class_id_plafond == 0 ? '3' : parseInt(visit?.class_id_plafond) - 1)
        ekbirth_weight = 0;

        class_id_eval = visit?.class_id === '10' ? visit?.class_id_plafond : visit?.class_id;

        ekupgrade_class_ind = ['2', '3'].includes(visit?.class_id_plafond) && ['3', '4'].includes(class_id_eval) &&
            ((class_id_eval > visit?.class_id_plafond ? visit?.class_id_plafond : class_id_eval) != visit?.class_id_plafond) ?
            '1' :
            '0';
        const classMap = {
            '3': 'kelas_2',
            '2': 'kelas_1',
            '6': 'vip',
            '11': 'vip'
        };
        ekupgrade_class_class = classMap[visit?.class_id] || '';
        ekupgrade_class_los = ''
        ekadd_payment_pct = '75'
        ekupgrade_class_payor = ''

        ekicu_indikator = ''
        ekicu_los = ''
        ekventilator_hour = ''
        ekuse_ind = ''
        ekstart_dttm = ''
        ekstop_dttm = ''

        ekapgar = ''
        ekappearance = ''
        ekpulse = ''
        ekgrimace = ''
        ekactivity = ''
        ekrespiration = ''

        ekpersalinan = 0
        ekusia_kehamilan = ''
        ekonset_kontraksi = ''
        ekgravida = ''
        ekpartus = ''
        ekabortus = ''

        ekcovid_indicator = ''
        ekcovid19_status_cd = ''
        ekcovid19_no_sep = ''
        eknomor_kartu_t = ''
        ekterapi_konvalesen = ''
        ekisoman_ind = ''
        ekbayi_lahir_status_cd = ''
        ekcovid19_rs_darurat_ind = ''
        ekcovid19_cc_ind = ''
        ekcovid19_co_insidense_ind = ''
        ekepisodes7 = ''
        ekepisodes8 = ''
        ekepisodes9 = ''
        ekepisodes10 = ''
        ekepisodes11 = ''
        ekepisodes12 = ''
        eklab_asam_laktat = ''
        eklab_d_dimer = ''
        eklab_anti_hiv = ''
        eklab_procalcitonin = ''
        eklab_analisa_gas = ''
        eklab_crp = ''
        eklab_pt = '';
        eklab_aptt = ''
        eklab_albumin = ''
        eklab_kultur = ''
        eklab_waktu_pendarahan = ''
        ekrad_thorax_ap_pa = ''
        ekpemulasaraan_jenazah = ''
        ekkantong_jenazah = ''
        ekpeti_jenazah = ''
        ekplastik_erat = ''
        ekdesinfektan_jenazah = ''
        ekmobil_jenazah = ''
        ekdesinfektan_mobil_jenazah = ''

        ekprosedur_non_bedah = 0.0;
        ekprosedur_bedah = 0.0;
        ekkonsultasi = 0.0;
        ektenaga_ahli = 0.0;
        ekkeperawatan = 0.0;
        ekpenunjang = 0.0;
        ekradiologi = 0.0;
        eklaboratorium = 0.0;
        ekpelayanan_darah = 0.0;
        ekrehabilitasi = 0.0;
        ekkamar = 0.0;
        ekrawat_intensif = 0.0;
        eksewa_alat = 0.0;
        ekobat = 0.0;
        ekobat_kronis = 0.0;
        ekobat_kemoterapi = 0.0;
        ekalkes = 0.0;
        ekbmhp = 0.0;
        ektotalBillEklaim = 0.0;
        declareAddUnuDiag()
        declareAddUnuProc()
        declareAddInaDiag()
        declareAddInaProc()
    }
    const declareAddUnuDiag = () => {
        initializeSearchDiag("searchUnuDiag", 'diag');
        $("#searchUnuDiag").on('select2:select', function(e) {
            let data = {
                kddiag: $("#searchUnuDiag").val(),
                nmdiag: $("#searchUnuDiag").text()
            }
            addUnuDiag(data)
            $("#searchUnuDiag").click()
            // $('html,body').animate({
            //         scrollTop: $("#searchUnuDiag").offset().top - 50
            //     },
            //     'slow', 'swing');
            $("#searchUnuDiag").click()
            $("#searchUnuDiag").select2('open')
            $("#searchUnuDiag").text(null).trigger('change');
            $("#searchUnuDiag").val(null).trigger('change');
        });
    }
    const declareAddUnuProc = () => {
        initializeSearchDiag("searchUnuProc", 'proc');
        $("#searchUnuProc").on('select2:select', function(e) {
            let data = {
                kddiag: $("#searchUnuProc").val(),
                nmdiag: $("#searchUnuProc").text()
            }
            addUnuProc(data)
            $("#searchUnuProc").click()
            // $('html,body').animate({
            //         scrollTop: $("#searchUnuProc").offset().top - 50
            //     },
            //     'slow', 'swing');
            $("#searchUnuProc").click()
            $("#searchUnuProc").select2('open')
            $("#searchUnuProc").text(null).trigger('change');
            $("#searchUnuProc").val(null).trigger('change');
        });
    }
    const declareAddInaDiag = () => {
        initializeSearchDiag("searchInaDiag", 'diag');
        $("#searchInaDiag").on('select2:select', function(e) {
            let data = {
                kddiag: $("#searchInaDiag").val(),
                nmdiag: $("#searchInaDiag").text()
            }
            addInaDiag(data)
            $("#searchInaDiag").click()
            // $('html,body').animate({
            //         scrollTop: $("#searchInaDiag").offset().top - 50
            //     },
            //     'slow', 'swing');
            $("#searchInaDiag").click()
            $("#searchInaDiag").select2('open')
            $("#searchInaDiag").text(null).trigger('change');
            $("#searchInaDiag").val(null).trigger('change');
        });
    }
    const declareAddInaProc = () => {
        initializeSearchDiag("searchInaProc", 'proc');
        $("#searchInaProc").on('select2:select', function(e) {
            let data = {
                kddiag: $("#searchInaProc").val(),
                nmdiag: $("#searchInaProc").text()
            }
            addInaProc(data)
            $("#searchInaProc").click()
            // $('html,body').animate({
            //         scrollTop: $("#searchInaProc").offset().top - 50
            //     },
            //     'slow', 'swing');
            $("#searchInaProc").click()
            $("#searchInaProc").select2('open')
            $("#searchInaProc").text(null).trigger('change');
            $("#searchInaProc").val(null).trigger('change');
        });
    }



    function addUnuDiag(props) {
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        let diagcat = props?.diagcat;
        iUnuDiag++;
        $("#ekbodyDiagUnu")
            .append($(`<tr id="ekbodyDiagUnu${iUnuDiag}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="unuDiag[]" id="ekunuDiag${iUnuDiag}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="unuDiagName[]" id="ekunuDiagName${iUnuDiag}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($('<td>')
                    .append($(`<div class="p-2">`)
                        .append($('<select class="form-select">')
                            .attr('name', 'unuDiagCat[]').attr('id', 'unuDiagCat' + iUnuDiag) <?php foreach ($diagCat as $key => $value) { ?>
                                .append($("<option>")
                                    .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                                ) <?php } ?>
                        )
                    )
                )
                .append($(`<td><button type="button" onclick='$("#ekbodyDiagUnu${iUnuDiag}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`))
            )
        const rowCount = document.querySelectorAll("#ekbodyDiagUnu tr").length;
        console.log(rowCount)
        if (diagcat != null) {
            $("#unuDiagCat" + iUnuDiag).val(diagcat)
        } else {
            if (rowCount == 1)
                $("#unuDiagCat" + iUnuDiag).val(8)
            else
                $("#unuDiagCat" + iUnuDiag).val(9)
        }

        // initializeDiagSelect2("ekunuDiag" + iUnuDiag, initialvalue, initialname)
    }

    function addUnuProc(props) {
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        iUnuProc++;
        $("#ekbodyProcUnu")
            .append($(`<tr id="ekbodyProcUnu${iUnuProc}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="unuProc[]" id="ekunuProc${iUnuProc}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="unuProcName[]" id="ekunuProcName${iUnuProc}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($(`<td><button type="button" onclick='$("#ekbodyProcUnu${iUnuProc}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`))
            )
    }

    function addInaDiag(props) {
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        let diagcat = props?.diagcat;
        iInaDiag++;
        $("#ekbodyDiagIna")
            .append($("<tr>")
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="inaDiag[]" id="ekinaDiag${iInaDiag}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="inaDiagName[]" id="ekinaDiagName${iInaDiag}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($('<td>')
                    .append($('<select class="form-select">')
                        .attr('name', 'inaDiagCat[]').attr('id', 'inaDiagCat' + iInaDiag) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                    )
                )
            )
        const rowCount = document.querySelectorAll("#ekbodyDiagIna tr").length;
        console.log(rowCount)
        if (diagcat != null) {
            $("#inaDiagCat" + iInaDiag).val(diagcat)
        } else {
            if (rowCount == 1)
                $("#inaDiagCat" + iInaDiag).val(18)
            else
                $("#inaDiagCat" + iInaDiag).val(19)
        }
    }

    function addInaProc(props) {
        let kddiag = props?.kddiag;
        let nmdiag = props?.nmdiag;
        iInaProc++;
        $("#ekbodyProcIna")
            .append($(`<tr id="ekbodyProcIna${iInaProc}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="inaProc[]" id="ekinaProc${iInaProc}" value="${kddiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width">
                    <input type="text" name="inaProcName[]" id="ekinaProcName${iInaProc}" value="${nmdiag}" class="form-control" readonly>
                    </div>`)
                )
                .append($(`<td><button type="button" onclick='$("#ekbodyProcIna${iInaProc}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`))
            )
    }

    function copyUnuToInaDiag() {
        $("#ekbodyDiagIna").empty(); // Kosongkan isi tujuan terlebih dahulu
        let rows = $("#ekbodyDiagUnu tr");

        let iInaDiag = 0;
        rows.each(function() {
            let $row = $(this);
            let kddiag = $row.find('select[name="unuDiag[]"] option:selected').val();
            let nmdiag = $row.find('select[name="unuDiag[]"] option:selected').text();
            let diagcat = $row.find('select[name="unuDiagCat[]"]').val();

            iInaDiag++;
            let $newRow = $(`<tr id="ekbodyDiagIna${iInaDiag}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width"><select id="ekinaDiag${iInaDiag}" class="form-control" name="inaDiag[]">
                    <option value="${kddiag}">${nmdiag}</option>
                </select>
                <input type="hidden" name="inaDiagName[]" id="ekinaDiagName${iInaDiag}" value="${nmdiag}">
                </div>`)
                )
                .append($('<td>')
                    .append($(`<div class="p-2">`)
                        .append($('<select class="form-select">')
                            .attr('name', 'inaDiagCat[]')
                            .attr('id', 'inaDiagCat' + iInaDiag) <?php foreach ($diagCat as $key => $value) { ?>
                                .append($("<option>")
                                    .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>')
                                    .html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                                ) <?php } ?>
                        )
                    )
                )
                .append($(`<td><button type="button" onclick='$("#ekbodyDiagIna${iInaDiag}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`));

            // Set kategori diagnosa yang sama dengan versi "unu"
            if (diagcat != null) {
                $newRow.find(`#inaDiagCat${iInaDiag}`).val(parseInt(diagcat) + 10);
            }

            $("#ekbodyDiagIna").append($newRow);
        });


        $("#ekbodyProcIna").empty(); // Kosongkan tabel tujuan terlebih dahulu
        rows = $("#ekbodyProcUnu tr");

        let iInaProc = 0;
        rows.each(function() {
            let $row = $(this);
            let kddiag = $row.find('select[name="unuProc[]"] option:selected').val();
            let nmdiag = $row.find('select[name="unuProc[]"] option:selected').text();

            iInaProc++;
            let $newRow = $(`<tr id="ekbodyProcIna${iInaProc}">`)
                .append($("<td>")
                    .append(`<div class="p-2 select2-full-width"><select id="ekinaProc${iInaProc}" class="form-control" name="inaProc[]">
                    <option value="${kddiag}">${nmdiag}</option>
                </select>
                <input type="hidden" name="inaProcName[]" id="ekinaProcName${iInaProc}" value="${nmdiag}">
                </div>`)
                )
                .append($(`<td><button type="button" onclick='$("#ekbodyProcIna${iInaProc}").remove()' class="btn closebtn btn-xs pull-right text-danger" data-toggle="modal" title=""><i class="fa fa-trash"></i></button></td>`));

            $("#ekbodyProcIna").append($newRow);
        });
    }

    function setEklaimData() {
        if (currentStep < 3) {
            $("#ekfinalklaimbtn").slideUp()
        } else {
            $("#ekfinalklaimbtn").slideDown()
        }

        $("#ekcurrentStep").val(currentStep)
        $("#ektrans_id").val(visit?.trans_id)
        $("#ekvisit_id").val(visit?.visit_id)
        $("#eknosep").val(visit?.no_skp)
        $("#eknosep_inap").val(visit?.no_skpinap)
        $("#eknama_pasien").val(visit?.diantar_oleh)
        $("#ekgender").val(visit?.gender)
        $("#eknomor_rm").val(visit?.no_registration)
        $("#ektgl_lahir").val(ektgl_lahir) //blm ada data
        $("#eknama_dokter").val(eknama_dokter)

        $("#eknomor_kartu").val(visit?.pasien_id)
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

        //upgradeclass
        if (ekupgrade_class_ind == '1') {
            $("#eklaimupgrade_class_ind1").prop("checked", true)
            $(".upgradeClassParam").slideDown()
        } else {
            $("#eklaimupgrade_class_ind0").prop("checked", true)
            $(".upgradeClassParam").slideUp()
        }
        $("#ekupgrade_class_class").val(ekupgrade_class_class)
        $("#ekupgrade_class_los").val(ekupgrade_class_los)
        $("#ekadd_payment_pct").val(ekadd_payment_pct)
        $("#ekupgrade_class_payor").val(ekupgrade_class_payor)


        //parameter ICU
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
        if (ekpersalinan == 1) {
            $("#eklaimpersalinan1").prop("checked", true)
        } else {
            $("#eklaimpersalinan0").prop("checked", true)
        }
        $("#ekusia_kehamilan").val(ekusia_kehamilan)
        $("#ekonset_kontraksi").val(ekonset_kontraksi)
        $("#ekgravida").val(ekgravida)
        $("#ekpartus").val(ekpartus)
        $("#ekabortus").val(ekabortus)
        if (ekdelivery.length > 0) {
            $.each(ekdelivery, (key, value) => {
                addEklaimPersalinan(value)
            })
        }

        $('#ektarif_poli_eks').val(ektarif_poli_eks)

        // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
        //COVID
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

        // tarif
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

    // function setEklaimData() {

    //     $("#ekcurrentStep").val(currentStep)
    //     $("#ektrans_id").val(ektrans_id)
    //     $("#ekvisit_id").val(ekvisit_id)
    //     $("#eknosep").val(eknosep)
    //     $("#eknosep_inap").val(eknosep_inap)
    //     $("#eknama_pasien").val(eknama_pasien)
    //     $("#ekgender").val(ekgender)
    //     $("#eknomor_rm").val(eknomor_rm)
    //     $("#ektgl_lahir").val(ektgl_lahir)
    //     $("#eknama_dokter").val(eknama_dokter)


    //     $("#eknomor_kartu").val(eknomor_kartu)
    //     $("#eknomor_sep").val(eknomor_sep)
    //     $("#ekpayor_id").val(ekpayor_id)
    //     $("#ekpayor_cd").val(ekpayor_cd)
    //     $("#payor").val(ekpayor_id + '-' + ekpayor_cd)
    //     $("#ekcob_cd").val(ekcob_cd)
    //     $("#ekkode_tarif").val(ekkode_tarif)

    //     $("#ekjenis_rawat").val(ekjenis_rawat)
    //     $("#ekkelas_rawat").val(ekkelas_rawat)
    //     $("#flatektgl_masuk").val(ektgl_masuk).trigger("change")
    //     $("#flatektgl_pulang").val(ektgl_pulang).trigger("change")
    //     $("#ekcara_masuk").val(ekcara_masuk)
    //     $("#ekdischarge_status").val(ekdischarge_status)
    //     $("#ekcoder_nik").val(ekcoder_nik)
    //     $("#ektension_upper").val(ektension_upper)
    //     $("#ektension_below").val(ektension_below)
    //     $("#ekadl_sub_acute").val(ekadl_sub_acute)
    //     $("#ekadl_chronic").val(ekadl_chronic)
    //     $("#ekdializer_single_use").val(ekdializer_single_use)
    //     $("#ekkantong_darah").val(ekkantong_darah)
    //     $("input[name=upgrade_class_ind][value=" + ekupgrade_class_ind + "]").prop('checked', true);
    //     if (ekupgrade_class_ind == '1') {
    //         $(".upgradeClassParam").slideDown()
    //     } else {
    //         $(".upgradeClassParam").slideUp()
    //     }
    //     $("#ekupgrade_class_class").val(ekupgrade_class_class)
    //     $("#ekupgrade_class_los").val(ekupgrade_class_los)
    //     $("#ekadd_payment_pct").val(ekadd_payment_pct)
    //     $("#ekupgrade_class_payor").val(ekupgrade_class_payor)

    //     $("#ekicu_indikator").val(ekicu_indikator)
    //     $("#ekicu_los").val(ekicu_los)
    //     $("#ekventilator_hour").val(ekventilator_hour)
    //     $("#ekuse_ind").val(ekuse_ind)
    //     $("#ekstart_dttm").val(ekstart_dttm)
    //     $("#ekstop_dttm").val(ekstop_dttm)
    //     $("#ekbirth_weight").val(ekbirth_weight)

    //     // $("input[name=apgar][value=" + ekapgar + "]").prop('checked', true);
    //     // $("#ekmnt1appearance").val(ekapgar[0].appearance)
    //     // $("#ekmnt1pulse").val(ekapgar[0].pulse)
    //     // $("#ekmnt1grimace").val(ekapgar[0].grimace)
    //     // $("#ekmnt1activity").val(ekapgar[0].activity)
    //     // $("#ekmnt1respiration").val(ekapgar[0].respiration)
    //     // $("#ekmnt5appearance").val(ekapgar[1].appearance)
    //     // $("#ekmnt5pulse").val(ekapgar[1].pulse)
    //     // $("#ekmnt5grimace").val(ekapgar[1].grimace)
    //     // $("#ekmnt5activity").val(ekapgar[1].activity)
    //     // $("#ekmnt5respiration").val(ekapgar[1].respiration)

    //     // $("input[name=persalinan][value=" + ekpersalinan + "]").prop('checked', true);
    //     $("#ekusia_kehamilan").val(ekusia_kehamilan)
    //     $("#ekonset_kontraksi").val(ekonset_kontraksi)
    //     $("#ekgravida").val(ekgravida)
    //     $("#ekpartus").val(ekpartus)
    //     $("#ekabortus").val(ekabortus)

    //     $('#ektarif_poli_eks').val(ektarif_poli_eks)

    //     // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
    //     $("#ekcovid19_status_cd").val(ekcovid19_status_cd)
    //     $("#eknomor_kartu_t").val(eknomor_kartu_t)
    //     $("#ekcovid19_no_sep").val(ekcovid19_no_sep)
    //     $("#ekterapi_konvalesen").val(ekterapi_konvalesen)
    //     $("#ekisoman_ind").val(ekisoman_ind)
    //     $("#ekbayi_lahir_status_cd").val(ekbayi_lahir_status_cd)
    //     $("#ekcovid19_rs_darurat_ind").val(ekcovid19_rs_darurat_ind)
    //     $("#ekcovid19_cc_ind").val(ekcovid19_cc_ind)
    //     $("#ekcovid19_co_insidense_ind").val(ekcovid19_co_insidense_ind)
    //     $("#ekepisodes7").val(ekepisodes7)
    //     $("#ekepisodes8").val(ekepisodes8)
    //     $("#ekepisodes9").val(ekepisodes9)
    //     $("#ekepisodes10").val(ekepisodes10)
    //     $("#ekepisodes11").val(ekepisodes11)
    //     $("#ekepisodes12").val(ekepisodes12)
    //     $("#eklab_asam_laktat").val(eklab_asam_laktat)
    //     $("#eklab_d_dimer").val(eklab_d_dimer)
    //     $("#eklab_anti_hiv").val(eklab_anti_hiv)
    //     $("#eklab_procalcitonin").val(eklab_procalcitonin)
    //     $("#eklab_analisa_gas").val(eklab_analisa_gas)
    //     $("#eklab_crp").val(eklab_crp)
    //     $("#eklab_aptt").val(eklab_aptt)
    //     $("#eklab_pt").val(eklab_pt)
    //     $("#eklab_albumin").val(eklab_albumin)
    //     $("#eklab_kultur").val(eklab_kultur)
    //     $("#eklab_waktu_pendarahan").val(eklab_waktu_pendarahan)
    //     $("#ekrad_thorax_ap_pa").val(ekrad_thorax_ap_pa)
    //     $("#ekpemulasaraan_jenazah").val(ekpemulasaraan_jenazah)
    //     $("#ekkantong_jenazah").val(ekkantong_jenazah)
    //     $("#ekpeti_jenazah").val(ekpeti_jenazah)
    //     $("#ekplastik_erat").val(ekplastik_erat)
    //     $("#ekdesinfektan_jenazah").val(ekdesinfektan_jenazah)
    //     $("#ekmobil_jenazah").val(ekmobil_jenazah)
    //     $("#ekdesinfektan_mobil_jenazah").val(ekdesinfektan_mobil_jenazah)

    //     $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
    //     $("#ekprosedur_bedah").val((ekprosedur_bedah))
    //     $("#ekkonsultasi").val((ekkonsultasi))
    //     $("#ektenaga_ahli").val((ektenaga_ahli))
    //     $("#ekkeperawatan").val((ekkeperawatan))
    //     $("#ekpenunjang").val((ekpenunjang))
    //     $("#ekradiologi").val((ekradiologi))
    //     $("#eklaboratorium").val((eklaboratorium))
    //     $("#ekpelayanan_darah").val((ekpelayanan_darah))
    //     $("#ekrehabilitasi").val((ekrehabilitasi))
    //     $("#ekkamar").val((ekkamar))
    //     $("#ekrawat_intensif").val((ekrawat_intensif))
    //     $("#ekobat").val((ekobat))
    //     $("#ekobat_kronis").val((ekobat_kronis))
    //     $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
    //     $("#ekalkes").val((ekalkes))
    //     $("#ekbmhp").val((ekbmhp))
    //     $("#eksewa_alat").val((eksewa_alat))
    //     $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))


    // }

    function setEnableEklaim(bool) {

        $('#formeklaim input').attr('disabled', bool);
        $('#formeklaim textarea').attr('disabled', bool);
        $('#formeklaim select').attr('disabled', bool);


    }

    var grouperResp;

    function eklaimSetKlaim(props) {
        eknosep = props?.nosep
        eknosep_inap = props?.nosep_inap
        // eknomor_sep = props?.nosep_klaim
        eknomor_rm = props?.nomr ?? visit?.no_registration
        ekpayor_id = props?.payor_id
        ekpayor_cd = props?.payor_cd
        ekcob_cd = props?.cob_cd

        ekjenis_rawat = props?.jnsrawat
        ektgl_masuk = (props?.tgl_masuk)
        ektgl_masuk = ektgl_masuk.substring(0, 16)
        ektgl_pulang = props?.tgl_keluar
        ektgl_pulang = ektgl_pulang.substring(0, 16)
        ekcara_masuk = props?.cara_masuk
        ekdischarge_status = eklaimCaraKeluar[props?.discharge_status]
        ekcoder_nik = props?.coder_nik
        eknama_dokter = props?.dokter
        ektarif_poli_eks = props?.tarif_poli_eks
        ekkode_tarif = props?.kodetarif
        ektension_upper = props?.sistole
        ektension_below = props?.diastole
        ekadl_sub_acute = props?.adl_sub_acute
        ekadl_chronic = props?.adl_chronic
        ekdializer_single_use = props?.dializer_single_use
        ekkantong_darah = props?.kantong_darah
        ekkelas_rawat = props?.klsrawat
        ekbirth_weight = props?.birthweight
    }

    function eklaimSetTarif(props) {
        ekprosedur_non_bedah = parseFloat(props.prosedur_non_bedah);
        ekprosedur_bedah = parseFloat(props.prosedur_bedah);
        ekkonsultasi = parseFloat(props.konsultasi);
        ektenaga_ahli = parseFloat(props.tenaga_ahli);
        ekkeperawatan = parseFloat(props.keperawatan);
        ekpenunjang = parseFloat(props.penunjang);
        ekradiologi = parseFloat(props.radiologi);
        eklaboratorium = parseFloat(props.laboratorium);
        ekpelayanan_darah = parseFloat(props.pelayanan_darah);
        ekrehabilitasi = parseFloat(props.rehabilitasi);
        ekkamar = parseFloat(props.kamar);
        ekrawat_intensif = parseFloat(props.rawat_intensif);
        ekobat = parseFloat(props.obat);
        ekobat_kronis = parseFloat(props.obat_kronis);
        ekobat_kemoterapi = parseFloat(props.obat_kemoterapi);
        ekalkes = parseFloat(props.alkes);
        ekbmhp = parseFloat(props.bmhp);
        eksewa_alat = parseFloat(props.sewa_alat);
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
    }

    function eklaimSetPersalinan(props) {
        ekpersalinan = 1
        ekusia_kehamilan = props?.usia_kehamilan
        ekonset_kontraksi = props?.onset_kontraksi
        ekgravida = props?.gravida
        ekpartus = props?.partus
        ekabortus = props?.abortus
    }

    function eklaimSetUpgrade(props) {
        ekupgrade_class_ind = props?.upgrade_class_id
        const classMap = {
            '3': 'kelas_2',
            '2': 'kelas_1',
            '6': 'vip',
            '11': 'vip'
        };
        ekupgrade_class_class = props?.upgrade_class_class
        ekupgrade_class_los = props?.upgrade_class_los
        ekadd_payment_pct = props?.add_payment_pct
        ekupgrade_class_payor = props?.upgrade_class_payor
    }

    function eklaimSetDiagnosa(props) {
        $("#ekbodyDiagUnu").html("")
        $("#ekbodyDiagIna").html("")
        $.each(props, (key, value) => {
            let data = {
                kddiag: value?.diagnosa_id,
                nmdiag: value?.diagnosa_name,
                diagcat: value?.diag_cat
            }
            if (eknomor_sep + 'unu' == value?.pasien_diagnosa_id)
                addUnuDiag(data)
            if (eknomor_sep + 'ina' == value?.pasien_diagnosa_id)
                addInaDiag(data)
        })
    }

    function eklaimSetProcedure(props) {
        $("#ekbodyProcUnu").html("")
        $("#ekbodyProcIna").html("")
        $.each(props, (key, value) => {
            let data = {
                kddiag: value?.diagnosa_id,
                nmdiag: value?.diagnosa_name
            }
            if (eknomor_sep + 'unu' == value?.pasien_diagnosa_id)
                addUnuProc(data)
            if (eknomor_sep + 'ina' == value?.pasien_diagnosa_id)
                addInaProc(data)
        })
    }

    function getEklaimData(nosep_klaim) {
        postData({
            'nosep_klaim': nosep_klaim,
            'trans_id': visit?.trans_id
        }, 'admin/eklaimcontroller/getEklaimData', (res) => {
            console.log(res)
            if (res?.data.klaim.length > 0) {
                eklaimSetKlaim(res?.data?.klaim)
            }
            if (res?.data.covid) {}
            if (res?.data?.jenazah) {

            }
            if (res?.data?.tarif) {
                eklaimSetTarif(res?.data?.tarif)
            } else {
                getBillEklaim18(visit?.trans_id)
            }
            if (res?.data?.persalinan) {
                eklaimSetPersalinan(res?.data?.persalinan)
            }
            if (res?.data?.delivery) {
                ekdelivery = res?.data?.delivery
            }
            if (res?.data?.upgrade) {
                eklaimSetUpgrade(res?.data?.upgrade)
            }
            if (res?.data?.diagnosa) {
                eklaimSetDiagnosa(res?.data?.diagnosa)
            }
            if (res?.data?.procedure) {
                eklaimSetProcedure(res?.data?.procedure)
            }
            if (res?.data?.grouper) {
                setGrouperResult(res?.data?.grouper)
            }

            setEklaimData()
        })
        // $.ajax({
        //     url: '<?php echo base_url(); ?>admin/eklaimcontroller/getEklaimData',
        //     type: "POST",
        //     data: JSON.stringify({
        //         'nosep_klaim': nosep_klaim,
        //         'trans_id': visit?.trans_id
        //     }),
        //     dataType: 'json',
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {

        //         if (data.nosep_klaim != '' && typeof data.nosep_klaim !== 'undefined') {
        //             ekklaim_final = data.klaim_status
        //             eknosep = data.nosep
        //             eknosep_inap = data.nosep_inap
        //             eknomor_kartu = data.nokartu
        //             eknomor_sep = data.nosep_klaim
        //             eknomor_rm = data.nomr
        //             eknama_pasien = data.namapasien
        //             ekgender = data.gender
        //             ektgl_lahir = data.tgllahir
        //             ekpayor_id = data.payor_id
        //             ekpayor_cd = data.payor_cd
        //             ekcob_cd = data.cob_cd

        //             ekjenis_rawat = data.jnsrawat
        //             ektgl_masuk = (data.tgl_masuk)
        //             ektgl_masuk = ektgl_masuk.substring(0, 16)
        //             ektgl_pulang = data.tgl_keluar
        //             ektgl_pulang = ektgl_pulang.substring(0, 16)
        //             ekcara_masuk = data.cara_masuk
        //             ekdischarge_status = eklaimCaraKeluar[data.discharge_status]
        //             ekcoder_nik = data.coder_nik
        //             eknama_dokter = data.dokter
        //             ektarif_poli_eks = data.tarif_poli_eks
        //             ekkode_tarif = data.kodetarif
        //             ektension_upper = $("#aetension_upper").val()
        //             ektension_below = $("#aetension_below").val()
        //             ekadl_sub_acute = data.adl_sub_acute
        //             ekadl_chronic = data.adl_chronic
        //             ekdializer_single_use = data.dializer_single_use
        //             ekkantong_darah = data.kantong_darah
        //             ekkelas_rawat = data.klsrawat
        //             ekbirth_weight = data.birthweight

        //             ekupgrade_class_ind = data.upgrade_class_id
        //             ekupgrade_class_class = data.upgrade_class_class
        //             ekupgrade_class_los = data.upgrade_class_los
        //             ekadd_payment_pct = data.add_payment_pct
        //             ekupgrade_class_payor = data.upgrade_class_payor

        //             ekicu_indikator = data.icu_indikator
        //             ekicu_los = data.icu_los
        //             ekventilator_hour = data.ventilator_hour
        //             // ekuse_ind = ''
        //             // ekstart_dttm = ''
        //             // ekstop_dttm = ''

        //             // ekapgar = ''
        //             // ekappearance = ''
        //             // ekpulse = ''
        //             // ekgrimace = ''
        //             // ekactivity = ''
        //             // ekrespiration = ''

        //             // ekpersalinan = ''
        //             // ekusia_kehamilan = ''
        //             // ekonset_kontraksi = ''
        //             // ekgravida = ''
        //             // ekpartus = ''
        //             // ekabortus = ''

        //             // ekcovid_indicator = ''
        //             // ekcovid19_status_cd = ''
        //             // ekcovid19_no_sep = ''
        //             // eknomor_kartu_t = ''
        //             // ekterapi_konvalesen = ''
        //             // ekisoman_ind = ''
        //             // ekbayi_lahir_status_cd = ''
        //             // ekcovid19_rs_darurat_ind = ''
        //             // ekcovid19_cc_ind = ''
        //             // ekcovid19_co_insidense_ind = ''
        //             // ekepisodes7 = ''
        //             // ekepisodes8 = ''
        //             // ekepisodes9 = ''
        //             // ekepisodes10 = ''
        //             // ekepisodes11 = ''
        //             // ekepisodes12 = ''
        //             // eklab_asam_laktat = ''
        //             // eklab_d_dimer = ''
        //             // eklab_anti_hiv = ''
        //             // eklab_procalcitonin = ''
        //             // eklab_analisa_gas = ''
        //             // eklab_crp = ''
        //             // eklab_pt = '';
        //             // eklab_aptt = ''
        //             // eklab_albumin = ''
        //             // eklab_kultur = ''
        //             // eklab_waktu_pendarahan = ''
        //             // ekrad_thorax_ap_pa = ''
        //             // ekpemulasaraan_jenazah = ''
        //             // ekkantong_jenazah = ''
        //             // ekpeti_jenazah = ''
        //             // ekplastik_erat = ''
        //             // ekdesinfektan_jenazah = ''
        //             // ekmobil_jenazah = ''
        //             // ekdesinfektan_mobil_jenazah = ''


        //             ekprosedur_non_bedah = parseFloat(data.proc_nonbedah)
        //             ekprosedur_bedah = parseFloat(data.proc_bedah)
        //             ekkonsultasi = parseFloat(data.konsultasi)
        //             ektenaga_ahli = parseFloat(data.tenaga_ahli)
        //             ekkeperawatan = parseFloat(data.keperawatan)
        //             ekpenunjang = parseFloat(data.penunjang)
        //             ekradiologi = parseFloat(data.radiologi)
        //             eklaboratorium = parseFloat(data.laboratorium)
        //             ekpelayanan_darah = parseFloat(data.pelayanandarah)
        //             ekrehabilitasi = parseFloat(data.rehabilitasi)
        //             ekkamar = parseFloat(data.kamar)
        //             ekrawat_intensif = parseFloat(data.rawat_intensif)
        //             ekobat = parseFloat(data.obat)
        //             ekobat_kronis = parseFloat(data.obatkronis)
        //             ekobat_kemoterapi = parseFloat(data.obatkemoterapi)
        //             ekalkes = parseFloat(data.alkes)
        //             ekbmhp = parseFloat(data.bmhp)
        //             eksewa_alat = parseFloat(data.sewa_alat)

        //             ektotalBillEklaim =
        //                 ekprosedur_non_bedah +
        //                 ekprosedur_bedah +
        //                 ekkonsultasi +
        //                 ektenaga_ahli +
        //                 ekkeperawatan +
        //                 ekpenunjang +
        //                 ekradiologi +
        //                 eklaboratorium +
        //                 ekpelayanan_darah +
        //                 ekrehabilitasi +
        //                 ekkamar +
        //                 ekrawat_intensif +
        //                 ekobat +
        //                 ekobat_kronis +
        //                 ekobat_kemoterapi +
        //                 ekalkes +
        //                 ekbmhp +
        //                 eksewa_alat;

        //             if (ektotalBillEklaim == 0.0) {
        //                 getBillEklaim18('<?= $visit['trans_id']; ?>')
        //             }

        //             var respon01 = JSON.parse(data.respon_01)
        //             var respon02 = JSON.parse(data.respon_02)
        //             var respon03 = JSON.parse(data.respon_03)

        //             if (typeof respon01 !== 'undefined') {
        //                 if (respon01.metadata.code == 200) {
        //                     currentStep = 1
        //                     if (typeof respon02 !== 'undefined') {
        //                         if (respon02.metadata.code == 200) {
        //                             currentStep = 2
        //                             if (typeof respon03 !== 'undefined') {
        //                                 if (respon03.metadata.code == 200) {
        //                                     currentStep = 3

        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }



        //             grouperResp = JSON.parse(data.respon_03)


        //             setGrouperResult(grouperResp)
        //             if (currentStep == 3) {
        //                 $("#ekfinalklaimbtn").slideDown()
        //             }
        //             if (currentStep < 3) {
        //                 $("#ekfinalklaimbtn").slideUp()
        //             }
        //             if (ekklaim_final > 1) {
        //                 $("#ekformsubmit").slideUp()
        //                 $("#ekfinalklaimbtn").slideUp()
        //                 $("#ekeditbtn").slideDown()
        //                 setEnableEklaim(true)
        //             }
        //             setEklaimData()

        //         } else {
        //             if (ektotalBillEklaim == 0.0) {
        //                 getBillEklaim18('<?= $visit['trans_id']; ?>')
        //             }
        //             setEklaimData()
        //         }
        //     },
        //     error: function() {

        //     }
        // });
    }

    function getBillEklaim18(trans = null) {
        trans = trans ?? visit?.trans_id
        $.ajax({
            url: '<?php echo base_url(); ?>admin/eklaimcontroller/getBillEklaim18',
            type: "POST",
            data: JSON.stringify({
                'trans': trans,
                'visit': visit?.visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                var data = res?.data
                if (true) {
                    ekprosedur_non_bedah = formatCurrency(parseFloat(data?.prosedur_non_bedah))
                    ekprosedur_bedah = formatCurrency(parseFloat(data?.prosedur_bedah))
                    ekkonsultasi = formatCurrency(parseFloat(data?.konsultasi))
                    ektenaga_ahli = formatCurrency(parseFloat(data?.tenaga_ahli))
                    ekkeperawatan = formatCurrency(parseFloat(data?.keperawatan))
                    ekpenunjang = formatCurrency(parseFloat(data?.penunjang))
                    ekradiologi = formatCurrency(parseFloat(data?.radiologi))
                    eklaboratorium = formatCurrency(parseFloat(data?.laboratorium))
                    ekpelayanan_darah = formatCurrency(parseFloat(data?.pelayanan_darah))
                    ekrehabilitasi = formatCurrency(parseFloat(data?.rehabilitasi))
                    ekkamar = formatCurrency(parseFloat(data?.kamar))
                    ekrawat_intensif = formatCurrency(parseFloat(data?.rawat_intensif))
                    ekobat = formatCurrency(parseFloat(data?.obat))
                    ekobat_kronis = formatCurrency(parseFloat(data?.obat_kronis))
                    ekobat_kemoterapi = formatCurrency(parseFloat(data?.obat_kemoterapi))
                    ekalkes = formatCurrency(parseFloat(data?.alkes))
                    ekbmhp = formatCurrency(parseFloat(data?.bmhp))
                    eksewa_alat = formatCurrency(parseFloat(data?.sewa_alat))

                    ektotalBillEklaim = (
                        parseFloat(data?.prosedur_non_bedah) +
                        parseFloat(data?.prosedur_bedah) +
                        parseFloat(data?.konsultasi) +
                        parseFloat(data?.tenaga_ahli) +
                        parseFloat(data?.keperawatan) +
                        parseFloat(data?.penunjang) +
                        parseFloat(data?.radiologi) +
                        parseFloat(data?.laboratorium) +
                        parseFloat(data?.pelayanan_darah) +
                        parseFloat(data?.rehabilitasi) +
                        parseFloat(data?.kamar) +
                        parseFloat(data?.rawat_intensif) +
                        parseFloat(data?.obat) +
                        parseFloat(data?.obat_kronis) +
                        parseFloat(data?.obat_kemoterapi) +
                        parseFloat(data?.alkes) +
                        parseFloat(data?.bmhp) +
                        parseFloat(data?.sewa_alat));



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

                var apgareklaim = data?.apgarData

                console.log(apgareklaim)

            },
            error: function() {

            }
        });
    }

    function setGrouperResult(data) {
        if (data.metadata.code == 200) {
            var response = data.response
            var cbg = response?.cbg
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
            var sub_acute = response?.sub_acute
            if (typeof sub_acute !== 'undefined') {
                $("#sub_acutedescription").html(sub_acute.description)
                $("#sub_acutecode").html(sub_acute.code)
                $("#sub_acutetariff").html(formatCurrency(parseFloat(sub_acute.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var chronic = response?.chronic
            if (typeof chronic !== 'undefined') {
                $("#chronicdescription").html(chronic.description)
                $("#chroniccode").html(chronic.code)
                $("#chronictariff").html(formatCurrency(parseFloat(chronic.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var special_cmg_option = data?.special_cmg_option
            if (typeof special_cmg_result !== 'undefined')
                if (special_cmg_option.length > 0) {
                    special_cmg_option.forEach((element, key) => {
                        var code = special_cmg_option[key].code
                        var description = special_cmg_option[key].description
                        var type = special_cmg_option[key].type
                        type = type.replace(/\s+/g, '_').toLowerCase();
                        $("#" + type + "description").append($("<option>").attr("value", code).html(description).attr("onclick", 'postGrouper2("' + type + '","' + code + '")'))
                        $("#" + type + "description").prop("disabled", false)
                    });
                }
            var special_cmg_result = data?.response?.special_cmg
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
            errorSwal(data.metadata.message);
        }
    }
    var eklaimhasil;
    $("#formeklaim").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/eklaimcontroller/postEklaim',
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
                if (data.metadata.code == 200) {
                    successSwal(data.response);
                    setGrouperResult(data)
                    if (currentStep < 3) {
                        $("#ekfinalklaimbtn").slideUp()
                    } else {
                        $("#ekfinalklaimbtn").slideDown()
                    }
                } else {
                    errorSwal(data.metadata.message)
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorSwal(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
    $("#ekformgrouping").off().on('click', function() {
        postData({
            nomor_sep: eknomor_sep,
            trans_id: ektrans_id
        }, 'admin/eklaimcontroller/postGrouper', (res) => {
            console.log(res)
            grouperResp = res.data

            console.log(grouperResp)


            setGrouperResult(grouperResp)
            if (currentStep == 3) {
                $("#ekfinalklaimbtn").slideDown()
            }
            if (currentStep < 3) {
                $("#ekfinalklaimbtn").slideUp()
            }
            if (ekklaim_final > 1) {
                $("#ekformsubmit").slideUp()
                $("#ekfinalklaimbtn").slideUp()
                $("#ekeditbtn").slideDown()
                setEnableEklaim(true)
            }
        })
    })

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
            url: '<?php echo base_url(); ?>admin/eklaimcontroller/postGrouper2',
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
            url: '<?php echo base_url(); ?>admin/eklaimcontroller/finalKlaim',
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
                    $("#ekeditbtn").slideDown()
                    $("#ekfinalklaimbtn").slideUp()
                    $("#ekformsubmit").slideUp()

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
            url: '<?php echo base_url(); ?>admin/eklaimcontroller/editKlaim',
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
                    $("#ekeditbtn").slideUp()
                    $("#ekfinalklaimbtn").slideDown()
                    $("#ekformsubmit").slideDown()
                    setEnableEklaim(false)
                }
                $("#ekeditbtn").button('reset')

            },
            error: function() {

            }
        });
    }
</script>
<!-- PERSALINAN SEGMENT -->
<script>
    $("#eklaimpersalinan1").on("click", () => {
        $("#ekPersalinanModal").modal("show")
    })
    const addEklaimPersalinan = (props) => {
        const rowCount = $("#ekPersalinanBody tr").length
        $("#ekPersalinanBody").append(`<tr class="persalinanParam">
                <td class="persalinanBody persalinanBodyLeft"><input onchange="eklaimInput(this)" type="number" name="delivery_sequence[]" id="ekdelivery_sequence${rowCount}" placeholder="" value="1" min="1" step="1" class="form-control"></td>
                <td class="persalinanBody persalinanBodyMiddle"><input onchange="eklaimInput(this)" type="datetime-local" name="delivery_dttm[]" id="ekdelivery_dttm${rowCount}" placeholder="" value="" class="form-control"></td>
                <td class="persalinanBody">
                    <select name="delivery_method[]" id="ekdelivery_method${rowCount}" class="form-select">
                        <option value="vaginal">Vaginal</option>
                        <option value="sc">Sectio Caesarea</option>
                    </select>
                    <div>
                        <input type="hidden" name="use_manual[]" value="0">
                        <input type="checkbox" name="use_manual[]" id="ekuse_manual${rowCount}" value="1">
                        <label for="use_manual">Diambil</label>
                    </div>
                    <div>
                        <input type="hidden" name="use_forcep[]" value="0">
                        <input type="checkbox" name="use_forcep[]" id="ekuse_forcep${rowCount}" value="1">
                        <label for="use_forcep">Forcep</label>
                    </div>
                    <div>
                        <input type="hidden" name="use_vacuum[]" value="0">
                        <input type="checkbox" name="use_vacuum[]" id="ekuse_vacuum${rowCount}" value="1">
                        <label for="use_vacuum">Vacuum</label>
                    </div>
                </td>
                <td class="persalinanBody persalinanBodyMiddle">
                    <select name="letak_janin[]" id="ekletak_janin${rowCount}" class="form-select">
                        <option value="kepala">Kepala</option>
                        <option value="sungsang">Sungsang</option>
                        <option value="lintang">Lintang</option>
                    </select>
                </td>
                <td class="persalinanBody persalinanBodyright">
                    <select name="kondisi[]" id="ekkondisi${rowCount}" class="form-select">
                        <option value="livebirth">Live Birth</option>
                        <option value="stillbirth">Still Birth</option>
                    </select>
                </td>
                <td>
                    <div class="row position-relative">
                        <div class="col-md-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_spesimen_ambil[]" id="ekshk_spesimen_ambilya${rowCount}" value="ya">
                                <label class="form-check-label" for="shk_spesimen_ambilya">Diambil</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_spesimen_ambil[]" id="ekshk_spesimen_ambiltidak${rowCount}" value="tidak">
                                <label class="form-check-label" for="shk_spesimen_ambiltidak">Tidak Diambil</label>
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <h6>Lokasi pengambilan</h6>
                        <div class="col-md-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_lokasi[]" id="ekshk_lokasitumit${rowCount}" value="tumit">
                                <label class="form-check-label" for="ekshk_lokasitumit">Tumit</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_lokasi[]" id="ekshk_lokasivena${rowCount}" value="vena">
                                <label class="form-check-label" for="ekshk_lokasivena">Vena</label>
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <h6>Alasan</h6>
                        <div class="col-md-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_alasan[]" id="ekshk_alasantidak-dapat${rowCount}" value="tidak-dapat">
                                <label class="form-check-label" for="ekshk_alasantidak-dapat">Tidak Dapat</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="shk_alasan[]" id="ekshk_alasanakses-sulit${rowCount}" value="akses-sulit">
                                <label class="form-check-label" for="ekshk_alasanakses-sulit">Akses Sulit</label>
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <h6>Waktu Pengambilan</h6>
                        <div class="col-md-12">
                            <input name="shk_spesimen_dttm[]" id="ekshk_spesimen_dttm${rowCount}" type="datetime-local" class="form-control">
                        </div>
                    </div>
                </td>
            </tr>
        `)
        $(`#delivery_sequence${rowCount}`).val(props?.delivery_sequence ?? rowCount)
        $(`#ekdelivery_method${rowCount}`).val(props?.delivery_method)
        $(`#ekdelivery_dttm${rowCount}`).val(props?.delivery_dttm ?? get_date())
        $(`#ekuse_manual${rowCount}`).prop("checked", props?.use_manual == 1)
        $(`#ekuse_forcep${rowCount}`).prop("checked", props?.use_forcep == 1)
        $(`#ekuse_vacuum${rowCount}`).prop("checked", props?.use_vacuum == 1)
        $(`#ekletak_janin${rowCount}`).val(props?.letak_janin)
        $(`#ekkondisi${rowCount}`).val(props?.kondisi)
        if (props?.shk_spesimen_ambil) {
            $(`#ekshk_spesimen_ambil${props?.shk_spesimen_ambil}${rowCount}`).prop("checked", true)
        }
        if (props?.shk_lokasi) {
            $(`#ekshk_lokasi${props?.shk_lokasi}${rowCount}`).prop("checked", true)
        }
        if (props?.shk_alasan) {
            $(`#ekshk_alasan${props?.shk_alasan}${rowCount}`).prop("checked", true)
        }
        $(`#ekshk_spesimen_dttm${rowCount}`).val(props?.shk_spesimen_dttm ?? get_date())
    }
</script>