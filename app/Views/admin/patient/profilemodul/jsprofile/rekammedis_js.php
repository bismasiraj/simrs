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
</script>
<script type="text/javascript">
    var historyJson = new Array();
    var pasienDiagnosa = new Array();
    var pasienDiagnosa = <?= json_encode($pasienDiagnosa); ?>;
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        getDiagnosas()
        getProcedures()
        modalAddRm()
    })

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
        var option = new Option(pasienDiagnosa.dirujukke, pasienDiagnosa.dirujukke, true, true);
        $("#ardirujukke").append(option).trigger('change');
        $("#artgl_kontrol").val(pasienDiagnosa.tglkontrol)
        $("#arkdpoli_kontrol").val(pasienDiagnosa.clinic_id)
        $("#arprocedure_05").val(pasienDiagnosa.procedure_05)
        $("#arsuffer_type").val(pasienDiagnosa.suffer_type)


        if (typeof pasienDiagnosa.description !== 'undefined') {
            disableRM()
            $("#formaddrmbtn").hide()
            $("#formeditrm").show()
        }







        // holdModal('addRmModal')
        // getDataFillRekamMedis()

        <?php if (isset($pasienDiagnosaAll[0])) { ?>
            getHistoryRekamMedis()
        <?php } ?>

        tindakLanjut()

    }


    function saveBundleEncounterSS() {
        var jwtauth = localStorage.getItem('jwtauth')
        var ssToken = localStorage.getItem('ssToken')
        var clinicss = '';

        <?php
        $locationId = '';
        $namelocation = '';
        foreach ($clinic as $key => $value) {
            if ($clinic[$key]['clinic_id'] == $visit['clinic_id']) {
                $locationId = $clinic[$key]['sslocation_id'];
                $namelocation = $clinic[$key]['name_of_clinic'];
                break;
            }
        }
        // $practitioner_id = '';
        // $practitioner_name = '';
        // foreach ($employee as $key => $value) {
        //     if ($employee[$key]['sspractitioner_id'] == $visit['employee_id']) {
        //         $practitioner_id = $employee['sspractitioner_id'];
        //         $practitioner_name = $employee['fullname'];
        //     }
        // }
        ?>
        var sslocation_id = '<?= $locationId; ?>'
        var sslocation_name = '<?= $namelocation; ?>'
        var sspractitioner_id = '<?= $visit['sspractitioner_id'] ?? ''; ?>'
        var sspractitioner_name = '<?= $visit['sspractitioner_name'] ?? $visit['fullname']; ?>'
        var ssencounter_id = '<?= $visit['ssencounter_id']; ?>'
        var ssorganizationid = '<?= $orgunit['SSORGANIZATIONID']; ?>'

        // klinikBpjs.forEach((value, key) => {
        //     if (value[1] == $("#pvclinic_id").val()) {
        //         clinicss = value[3]
        //     }
        // })

        // var dpjpss = '';
        // Object.keys(ssdpjp).forEach(key => {
        //     if (key == $("#pvemployee_id").val()) {
        //         dpjpss = ssdpjp[key]
        //     }
        // });
        $.ajax({
            url: '<?php echo base_url(); ?>api/satusehat/postBundleEncounter',
            type: "POST",
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('jwtauth'),
                ssToken: (String)(localStorage.getItem('ssToken')),
                norm: <?= $visit['no_registration']; ?>,
                nik: $("#apasien_id").val()
            },
            data: JSON.stringify({
                'sslocation_id': sslocation_id,
                'sslocation_name': sslocation_name,
                'sspractitioner_id': sspractitioner_id,
                'sspractitioner_name': sspractitioner_name,
                'ssencounter_id': ssencounter_id,
                'ssorganizationid': ssorganizationid,
                'visit_id': '<?= $visit['visit_id']; ?>',
                'trans_id': '<?= $visit['trans_id']; ?>',
                'no_registration': '<?= $visit['no_registration']; ?>',
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#postingSS").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                console.log(data.ids)
                // $("#pvssencounter_id").val(data.id)

                if (typeof data.id !== 'undefined') {
                    $("#pvssencounter_id").val(data.id)
                    $("#formaddpvbtn").click()
                }
                // $("#postingSS").html('<i class="fa fa-plus"></i> <span > Simpan < /span>')
            },
            error: function(xhr) {
                if (xhr.status == '401') {
                    getSatuSehatToken()
                } else {
                    alert(xhr.statusText)
                }
                $("#postingSS").html('<i class="fa fa-plus"></i> <span> Satu Sehat </span>')
            },
            complete: function() {
                $("#postingSS").html('<i class="fa fa-plus"></i> <span> Satu Sehat </span>')
            }

        });
    }

    function generateBundle() {
        $.ajax({
            url: '<?php echo base_url(); ?>api/satusehat/postingBatch',
            type: "GET",
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('jwtauth'),
                ssToken: (String)(localStorage.getItem('ssToken')),
                norm: <?= $visit['no_registration']; ?>,
                nik: $("#apasien_id").val()
            },
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#postingSS").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                console.log(data)
            },
            error: function(xhr) {
                if (xhr.status == '401') {
                    getSatuSehatToken()
                } else {
                    alert(xhr.statusText)
                }
                $("#postingSS").html('<i class="fa fa-plus"></i> <span> Simpan </span>')
            },
            complete: function() {
                $("#postingSS").html('<i class="fa fa-plus"></i> <span> Simpan </span>')
            }

        });
    }
</script>