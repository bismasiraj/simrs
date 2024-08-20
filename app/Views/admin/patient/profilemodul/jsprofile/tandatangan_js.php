<script>
    $("#digitalSignForm").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        let formData = new FormData(this)
        let formDataObject = {};
        formData.forEach(function(value, key) {
            formDataObject[key] = value
        });
        let docData = new FormData(document.getElementById($("#signform").val()))
        let docDataObject = {};
        docData.forEach(function(value, key) {
            docDataObject[key] = value
        });
        // let data = [];
        var data = {
            signData: formDataObject,
            docData: docDataObject
        };
        $.ajax({
            url: '<?php echo base_url(); ?>signature/postingSignedDocsTable',
            type: "POST",
            // data: [docData, formData],
            data: JSON.stringify(data),
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
            $("#" + formId + ' .btn-edit').slideUp()
        } else {
            $("#" + formId + ' .btn-edit').slideDown()
        }
    }
</script>

<script>
    const addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title = null) => {
        if (user_type == 1) {
            $("#signvalid_date").val(container + "valid_date")
            $("#signvalid_user").val(container + "valid_user")
            $("#signvalid_pasien").val(container + "valid_pasien")
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type)
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        }

        $("#digitalSignModal").modal("show")
    }
    const addSignUserSatelite = (formId, container, body_id, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title) => {
        $("#" + formId).find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
        if (user_type == 1) {
            console.log(primaryKey)
            $("#signvalid_date").val(container + "valid_date" + body_id)
            $("#signvalid_user").val(container + "valid_user" + body_id)
            $("#signvalid_pasien").val(container + "valid_pasien" + body_id)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type)
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        }

        $("#digitalSignModal").modal("show")
    }
    const checkSignSignature = async (formId, primaryKey, formSaveBtn, docs_type = null) => {
        let docData = new FormData(document.getElementById(formId))
        let signId = $("#" + primaryKey).val()
        let docDataObject = {};
        docData.forEach(function(value, key) {
            docDataObject[key] = value
        });
        // let data = [];
        var data = {
            docData: docDataObject,
            signId: signId,
            docs_type: docs_type
        };

        return new Promise((resolve, reject) => {
            $.ajax({
                url: '<?php echo base_url(); ?>signature/checkSignedDocsTable',
                type: "POST",
                // data: [docData, formData],
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {},
                success: function(result) {
                    try {
                        // Handle success
                        if (result.error) {
                            console.error('Error:', result.error);
                        } else {
                            $.each(result, function(key, value) {
                                if (value.user_type == 1) {
                                    $("#" + formId).find(".valid_user").each(function() {
                                        $(this).val(value.sign_path)
                                    })
                                    console.log("qrcode: " + "#" + formId + "qrcode" + value.user_type)
                                    $("#" + formId + "qrcode" + value.user_type).html("")
                                    let qrcode = new QRCode(document.getElementById(formId + "qrcode" + value.user_type), {
                                        text: value.sign_path,
                                        width: 128,
                                        height: 128,
                                        colorDark: "#000000",
                                        colorLight: "#ffffff",
                                        correctLevel: QRCode.CorrectLevel.H
                                    });
                                    $("#" + formId + "signer" + value.user_type).html(value.fullname ?? value.user_id)
                                    console.log('Signature validity:', value.isValid);
                                }
                            })
                            // $("#" + formSaveBtn).trigger("click")
                        }
                    } catch (e) {
                        console.error('Invalid JSON response:', e);
                    }
                    resolve(result);

                },
                error: function(xhr) { // if error occured
                    console.log(xhr);
                },
                complete: function() {}
            });
        })
    }
    const checkSignSignatureAsync = async (data) => {
        $.ajax({
            url: '<?php echo base_url(); ?>signature/checkSignedDocs',
            type: "POST",
            // data: [docData, formData],
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(result) {
                return result
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                errorMsg(xhr);
            },
            complete: function() {}
        });
    }
</script>