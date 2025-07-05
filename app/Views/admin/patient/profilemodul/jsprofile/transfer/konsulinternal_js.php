<script>
    const setDataRujukInternal = async (data = null) => {
        $("#rujintvisitdate").val(get_date())
        $("#rujintclinicid").val(null)
        $("#rujintemployeeid").val(null)
        flatpickrInstances["flatrujintvisitdate"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );

        if (data) {
            $("#rujintvisitdate").val(data.visit_date)
            $("#rujintclinicid").val(data.clinic_id)
            $("#rujintemployeeid").val(data.employee_id)
        }
        $("#atransferrujukaninternalgroup").slideDown()
        $("#flatrujintvisitdate").trigger("change");

    }

    function postRujukInternal() {
        var visitJson = JSON.parse('<?= json_encode($visit); ?>');
        visitJson.visit_id = $("#atransferdocument_id").val()
        visitJson.clinic_id = $("#rujintclinicid").val()
        visitJson.visit_date = $("#rujintvisitdate").val()
        visitJson.booked_date = $("#rujintvisitdate").val()
        visitJson.employee_id = $("#rujintemployeeid").val()
        visitJson.clinic_id_from = '<?= $visit['clinic_id']; ?>'
        visitJson.employee_id_from = '<?= $visit['employee_id']; ?>'
        visitJson.way_id = '19'
        visitJson.isnew = '0'
        visitJson.class_room_id = null
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addvisit',
            type: "POST",
            data: visitJson,
            dataType: 'json',
            success: function(data) {
                $("#rujukInternalModal").modal("hide")
                successSwal("Simpan rujukan internal berhasil")
            }
        })
    }

    const getRujukInternal = (visitIdKonsul) => {
        postData({
            visitIdKonsul: pasienDiagnosaId
        }, 'admin/PatientOperationRequest/getExaminationData', (res) => {
            if (res?.respon === false) {
                // Jika data tidak ditemukan, gunakan newBodyId
                $(`#avtbody_id${suffix}`).val(newBodyId);
            } else {
                const data = res?.data[0];

                // Tentukan body_id untuk elemen
                const bodyIdFromData = data?.body_id === pasienDiagnosaId ? data?.body_id : newBodyId;

                // Perbarui nilai elemen HTML sesuai suffix
                $(`#avtbody_id${suffix}`).val(bodyIdFromData);

                // Render data jika body_id valid
                renderDataVitailSign(data);
            }
        });
    }

    $("#rujintclinicid").on("click", function() {
        $("#rujintemployeeid").html("");
        var clinicSelected = $("#rujintclinicid").val();
        // dokterdpjp.forEach((value, key) => {
        //     if (value[0] == clinicSelected) {
        //         $("#rujintemployeeid").append(new Option(value[2], value[1]));
        //     }
        // })
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getdokterrujukan',
            type: "POST",
            data: {
                clinicSelected: clinicSelected,
                rujintvisitdate: $("#rujintvisitdate").val(),
            },
            dataType: 'json',
            success: function(data) {
                $("#rujintemployeeid").html("")
                data.forEach((element, key) => {
                    $("#rujintemployeeid").append(new Option(element.fullname, element.employee_id));
                })
            }
        })
    });
</script>