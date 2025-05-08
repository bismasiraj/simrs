<script type='text/javascript'>
    educationintegrationjson = <?= json_encode($exam); ?>;
    $("#educationIntegrationTab").on("click", function() {
        $("#educationintegrationBody").html('')
        getEducationIntegrationAll()
    })

    function addRoweducationintegration(educationintegrationselect, key) {
        $("#educationintegrationBody").append($("<tr>")
            .append($("<td>").append(formatedDatetimeFlat(educationintegrationselect.examination_date)))
            .append($("<td>").html(educationintegrationselect.modified_by))
            .append($("<td>").html('<button type="button" onclick="editeducationintegration(' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            .append($("<td>").html('<button type="button" onclick="removeRacik(\'' + educationintegrationselect.body_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        )
    }

    educationintegrationjson.forEach((element, key) => {
        examselect = educationintegrationjson[key];
        addRoweducationintegration(examselect, key)
    });

    function addEducationIntegrationMenu() {
        $("#bodyEducationIntegration").html("")
        addEducationIntegration(1, 0, 'EducationIntegration', 'educationIntegrationBody', false)
    }

    function editeducationintegration(key) {
        $("#educationIntegrationBody").html("")
        // var examselect = examForassessment[key];

        // $.each(examselect, function(key, value) {
        //     $("#aeducationintegration" + key).val(value)
        // })
        $("#aeducationintegrationDocument").html("")
        addEducationIntegration(0, key, 'EducationIntegration', 'educationIntegrationBody')
        // $("#educationintegrationModal").modal("show")
        // $("#aeducationintegrationDocument").find("input, select, textarea").prop("disabled", false)
    }

    function copyeducationintegration(key) {
        var examselect = examForassessment[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#aeducationintegrationageday").val(examselect.ageday)
        $("#aeducationintegrationagemonth").val(examselect.agemonth)
        $("#aeducationintegrationageyear").val(examselect.ageyear)
        $("#aeducationintegrationanamnase").val(examselect.anamnase)
        $("#aeducationintegrationarm_diameter").val(examselect.arm_diameter)
        $("#aeducationintegrationbed_id").val(examselect.bed_id)
        $("#aeducationintegrationbody_id").val(bodyId)
        $("#aeducationintegrationclass_room_id").val(examselect.class_room_id)
        $("#aeducationintegrationclinic_id").val(examselect.clinic_id)
        $("#aeducationintegrationdescription").val(examselect.description)
        $("#aeducationintegrationdoctor").val(examselect.doctor)
        $("#aeducationintegrationemployee_id").val(examselect.employee_id)
        $("#aeducationintegrationexamination_date").val(get_date())
        $("#aeducationintegrationgender").val(examselect.gender)
        $("#aeducationintegrationheight").val(examselect.height)
        $("#aeducationintegrationinstruction").val(examselect.instruction)
        $("#aeducationintegrationisrj").val(examselect.isrj)
        $("#aeducationintegrationkal_id").val(examselect.kal_id)
        $("#aeducationintegrationkeluar_id").val(examselect.keluar_id)
        $("#aeducationintegrationnadi").val(examselect.nadi)
        $("#aeducationintegrationnafas").val(examselect.nafas)
        $("#aeducationintegrationno_registraiton").val(examselect.no_registraiton)
        $("#aeducationintegrationorg_unit_code").val(examselect.org_unit_code)
        $("#aeducationintegrationpemeriksaan").val(examselect.pemeriksaan)
        $("#aeducationintegrationpetugas").val(examselect.petugas)
        $("#aeducationintegrationsaturasi").val(examselect.saturasi)
        $("#aeducationintegrationstatus_pasien_id").val(examselect.status_pasien_id)
        $("#aeducationintegrationtemperature").val(examselect.temperature)
        $("#aeducationintegrationtension_below").val(examselect.tension_below)
        $("#aeducationintegrationtension_upper").val(examselect.tension_upper)
        $("#aeducationintegrationteraphy_desc").val(examselect.teraphy_desc)
        $("#aeducationintegrationtheaddress").val(examselect.theaddress)
        $("#aeducationintegrationtheid").val(examselect.pasien_id)
        $("#aeducationintegrationthename").val(examselect.diantar_oleh)
        $("#aeducationintegrationvisit_id").val(examselect.visit_id)
        $("#aeducationintegrationweight").val(examselect.weight)

        $("#aeducationintegrationorg_unit_code").val(examselect.org_unit_code)
        $("#aeducationintegrationpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#aeducationintegrationno_registration").val(examselect.no_registration)
        $("#aeducationintegrationvisit_id").val(examselect.visit_id)
        $("#aeducationintegrationtrans_id").val(examselect.trans_id)
        $("#aeducationintegrationbill_id").val(examselect.bill_id)
        $("#aeducationintegrationclass_room_id").val(examselect.class_room_id)
        $("#aeducationintegrationbed_id").val(examselect.bed_id)
        $("#aeducationintegrationin_date").val(examselect.in_date)
        $("#aeducationintegrationexit_date").val(examselect.exit_date)
        $("#aeducationintegrationkeluar_id").val(examselect.keluar_id)
        $("#aeducationintegrationimt_score").val(examselect.imt_score)
        $("#aeducationintegrationimt_desc").val(examselect.imt_desc)
        $("#aeducationintegrationpemeriksaan").val(examselect.pemeriksaan)
        $("#aeducationintegrationmedical_treatment").val(examselect.medical_treatment)
        $("#aeducationintegrationmodified_date").val(examselect.modified_date)
        $("#aeducationintegrationmodified_by").val(examselect.modified_by)
        $("#aeducationintegrationmodified_from").val(examselect.modified_from)
        $("#aeducationintegrationstatus_pasien_id").val(examselect.status_pasien_id)
        $("#aeducationintegrationageyear").val(examselect.ageyear)
        $("#aeducationintegrationagemonth").val(examselect.agemonth)
        $("#aeducationintegrationageday").val(examselect.ageday)
        $("#aeducationintegrationthename").val(examselect.thename)
        $("#aeducationintegrationtheaddress").val(examselect.theaddress)
        $("#aeducationintegrationtheid").val(examselect.theid)
        $("#aeducationintegrationisrj").val(examselect.isrj)
        $("#aeducationintegrationgender").val(examselect.gender)
        $("#aeducationintegrationdoctor").val(examselect.doctor)
        $("#aeducationintegrationkal_id").val(examselect.kal_id)
        $("#aeducationintegrationpetugas_id").val(examselect.petugas_id)
        $("#aeducationintegrationpetugas").val(examselect.petugas)
        $("#aeducationintegrationaccount_id").val(examselect.account_id)
        $("#aeducationintegrationkesadaran").val(examselect.kesadaran)
        $("#aeducationintegrationisvalid").val(examselect.isvalid)

        $("#aeducationintegrationanamnase").val(examselect.anamnase)
        $("#aeducationintegrationdescription").val(examselect.description)
        $("#aeducationintegrationweight").val(examselect.weight)
        $("#aeducationintegrationheight").val(examselect.height)
        $("#aeducationintegrationtemperature").val(examselect.temperature)
        $("#aeducationintegrationnadi").val(examselect.nadi)
        $("#aeducationintegrationtension_upper").val(examselect.tension_upper)
        $("#aeducationintegrationtension_lower").val(examselect.tension_lower)
        $("#aeducationintegrationsaturasi").val(examselect.saturasi)
        $("#aeducationintegrationnafas").val(examselect.nafas)
        $("#aeducationintegrationarm_diameter").val(examselect.arm_diameter)
        $("#aeducationintegrationpemeriksaan").val(examselect.pemeriksaan)

        $("#aeducationintegrationvs_status_id" + examselect.vs_status_id).prop("checked", true)

        $("#educationintegrationModal").modal("show")
        $("#formsaveaeducationintegrationbtnid").slideDown()
        $("#formeditaeducationintegrationid").slideUp()
    }
</script>

<script>
    function initialAddEducationIntegration() {
        $("#aeducationintegrationDocument").html("")
        addEducationIntegration(1, 0, 'EducationIntegration', 'aeducationintegrationDocument')
        $("#educationintegrationModal").modal("show")
        $("#aeducationintegrationDocument").find("input, select, textarea").prop("disabled", false)
    }
</script>
<script>
    function getEducationIntegrationAll() {
        $("#bodyEducationIntegration").html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationIntegrationAll',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': ''
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#educationintegrationBody").html(loadingScreen())
            },
            success: function(data) {
                $("#educationintegrationBody").html("")
                educationIntegrationAll = data.educationIntegration
                educationIntegrationDetailAll = data.educationIntegrationDetail
                educationIntegrationPlanAll = data.educationPlan
                educationIntegrationProvisionAll = data.educationProvision

                // educationIntegrationAll[]
                if (educationIntegrationAll.length > 0) {
                    editeducationintegration(educationIntegrationAll.length - 1)
                } else {
                    addEducationIntegrationMenu(1, 0, 'EducationIntegration', 'educationIntegrationBody')
                }
                // $.each(educationIntegrationAll, function(key, value) {
                //     // addEducationIntegration(1, 0, 'EducationIntegration', 'aeducationintegrationDocument')

                //     addRoweducationintegration(value, key)
                // })
            },
            error: function() {
                $("#educationintegrationBody").html(tempTablesNull())
            }
        });
    }
</script>
<script>
    const addEdducationFormIntegration = (bodyIdContainer, value_id) => {
        $("#aeducationintegrationDocument").html('')
        $("#educationintegrationModal").modal('show')
        getEducationFormIntegration(bodyIdContainer, 'aeducationintegrationDocument', value_id)
    }

    const getEducationFormIntegration = (bodyIdContainer, container, value_id) => {
        $("#" + container).html("")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getEducationFormIntegration',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'body_id': $("#" + bodyIdContainer).val(),
                'value_id': value_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                educationFormAll = data.educationForm

                let isexist = 0;


                $.each(educationFormAll, function(key, value) {
                    if (value.value_id == value_id) {
                        addEducationForm(0, key, bodyIdContainer, "aeducationintegrationDocument", false, value_id)
                        isexist = 1
                    }
                })

                if (isexist == 0) {
                    addEducationForm(1, 1, bodyIdContainer, 'aeducationintegrationDocument', false, value_id)
                }
            },
            error: function() {
                addEducationForm(1, 1, bodyIdContainer, 'aeducationintegrationDocument', false, value_id)
            }
        });
    }
</script>