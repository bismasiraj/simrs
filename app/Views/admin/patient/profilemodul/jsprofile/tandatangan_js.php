<script>
    function addSignUser(container, buttonId, formid) {
        $("#signvalid_date").val(container + "valid_date")
        $("#signvalid_user").val(container + "valid_user")
        $("#signvalid_pasien").val(container + "valid_pasien")
        $("#signtombolsave").val(buttonId)
        $("#signform").val(formid)

        $("#digitalSignModal").modal("show")
    }
    $("#digitalSignForm").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/checkpass',
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
                if (data) {
                    var valid_date = $("#signvalid_date").val()
                    var valid_user = $("#signvalid_user").val()
                    var valid_pasien = $("#signvalid_pasien").val()
                    var signButton = $("#signtombolsave").val()
                    var signform = $("#signform").val()

                    $("#" + signform).find(".valid-date").each(function() {
                        $(this).val(get_date())
                    })
                    $("#" + signform).find(".valid-user").each(function() {
                        $(this).val(get_bodyid())
                    })
                    $("#" + signform).find(".valid-pasien").each(function() {
                        $(this).val(get_bodyid())
                    })
                    $("#" + valid_date).val(get_date())
                    $("#" + valid_user).val(get_bodyid())
                    $("#" + valid_pasien).val(get_bodyid())
                    $("#" + signButton).trigger("click")
                    $("#digitalSignForm").find("input").val(null)
                }
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
        $("#digitalSignModal").modal("hide")

    }));
</script>
<script>
    function checkSign(formId) {
        var validUser = $("#" + formId + ' input[name="valid_user"]').val()

        if (validUser != '' && validUser != null) {
            $("#" + formId + ' .btn-edit').hide()
        } else {
            $("#" + formId + ' .btn-edit').show()
        }
    }
</script>