<script>
    $("#persalinanTab").on("click", function() {
        initiatePersalinan()
        getPersalinan()
    })
    $("#prslKBDN00503").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
    });
</script>
<script type="text/javascript">
    const getPersalinan = () => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPersalinan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                let persalinanData = data?.persalinan
                $.each(persalinanData, function(key, value) {
                    $.each(value, function(key1, value1) {
                        console.log(key1)
                        console.log(value1)
                        $("#prsl" + key1).val(value1)
                        $('input[type="radio"][name="' + key1 + '"][value="' + value1 + '"]').prop("checked", true)
                    })
                })
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    $("#formPersalinan").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/savePersalinan',
            type: "POST",
            data: new FormData(document.getElementById("formPersalinan")),
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
                    successSwal('Data berhasil diperbarui.');

                    disablePersalinan()
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                errorSwal("Gagal Di hapus")
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
</script>

<script>
    const initiatePersalinan = () => {
        $("#formPersalinan").find("input, select, textarea").val(null)
        $("#prslexamination_date").val(get_date())
        $("#prslorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#prslvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#prsltrans_id").val('<?= $visit['trans_id']; ?>')
        $("#prslbody_id").val(get_bodyid())
        $("#prslno_registration").val('<?= $visit['no_registration']; ?>')
    }
    const enablePersalinan = () => {
        $("#formPersalinanEditBtn").on("click", function(e) {
            e.preventDefault()
            $("#formPersalinan").find("input, select, textarea").prop("disabled", false)
            $("#formPersalinanSaveBtn").show()
            $("#formPersalinanEditBtn").hide()
            $("#formPersalinanSignBtn").hide()
            $("#formPersalinanCetakBtn").hide()
        })
    }
    const disablePersalinan = () => {
        $("#formPersalinan").find("input, select, textarea").prop("disabled", true)
        $("#formPersalinanSaveBtn").hide()
        if ($("#prslvalid_user").val() == '') {
            $("#formPersalinanEditBtn").show()
            $("#formPersalinanSignBtn").show()
            $("#formPersalinanCetakBtn").show()
        } else {
            $("#formPersalinanEditBtn").hide()
            $("#formPersalinanSignBtn").hide()
            $("#formPersalinanCetakBtn").hide()
        }
    }
</script>