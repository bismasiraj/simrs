<script>
    // $("#digitalSignForm").on('submit', (function(e) {
    //     e.preventDefault();
    //     let clicked_submit_btn = $(this).closest('form').find(':submit');
    //     let formData = new FormData(this)
    //     let formDataObject = {};
    //     formData.forEach(function(value, key) {
    //         formDataObject[key] = value
    //     });
    //     let docData = new FormData(document.getElementById($("#signform").val()))
    //     let docDataObject = {};
    //     docData.forEach(function(value, key) {
    //         docDataObject[key] = value
    //     });
    //     // let data = [];
    //     var data = {
    //         signData: formDataObject,
    //         docData: docDataObject
    //     };
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>signature/postingSignedDocsTable',
    //         type: "POST",
    //         // data: [docData, formData],
    //         data: JSON.stringify(data),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         beforeSend: function() {
    //             clicked_submit_btn.button('loading');
    //         },
    //         success: function(data) {
    //             if (data) {
    //                 var valid_date = $("#signvalid_date").val()
    //                 var valid_user = $("#signvalid_user").val()
    //                 var valid_pasien = $("#signvalid_pasien").val()
    //                 var signButton = $("#signtombolsave").val()
    //                 var signform = $("#signform").val()

    //                 $("#" + signform).find(".valid-date").each(function() {
    //                     $(this).val(get_date())
    //                 })
    //                 $("#" + signform).find(".valid-user").each(function() {
    //                     $(this).val(get_bodyid())
    //                 })
    //                 $("#" + signform).find(".valid-pasien").each(function() {
    //                     $(this).val(get_bodyid())
    //                 })
    //                 $("#" + valid_date).val(get_date())
    //                 $("#" + valid_user).val(get_bodyid())
    //                 $("#" + valid_pasien).val(get_bodyid())
    //                 $("#" + signButton).trigger("click")
    //                 $("#digitalSignForm").find("input").val(null)
    //             }
    //         },
    //         error: function(xhr) { // if error occured
    //             alert("Error occured.please try again");
    //             clicked_submit_btn.button('reset');
    //             errorMsg(xhr);
    //         },
    //         complete: function() {
    //             clicked_submit_btn.button('reset');
    //         }
    //     });
    //     $("#digitalSignModal").modal("hide")
    // }));
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
    const addSignUser = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title = null, columnName = null, value_id = null) => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);
        if (user_type == 1) {
            if (columnName == null)
                $("#signvalid_user").val("valid_user")
            else
                $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val("valid_pasien")
            $("#signvalid_date").val("valid_date")
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
            $("#password").val("<?= user()->password; ?>")
        } else if (user_type == 2) {
            if (columnName == null)
                $("#signvalid_user").val("valid_user")
            else
                $("#signvalid_user").val(columnName)
            $("#signvalid_date").val(container + "valid_date")
            $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val(columnName)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
            $("#password").val("<?= user()->password; ?>")
        } else {
            if (columnName == null)
                $("#signvalid_user").val("valid_user")
            else
                $("#signvalid_user").val(columnName)
            $("#signvalid_date").val(container + "valid_date")
            $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val(columnName)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
            $("#password").val("<?= user()->password; ?>")
        }

        $("#digitalSignModal").modal("show")
        $("#password").focus()
    }
    const addSignUserSatelite = (formId, container, body_id, primaryKey, buttonId, docs_type, user_type, sign_ke = 1,
        title) => {
        $("#" + formId).find(".btn-edit").each(function() {
            $(this).trigger("click")
        })
        if (user_type == 1) {
            $("#signvalid_date").val(container + "valid_date" + body_id)
            $("#signvalid_user").val(container + "valid_user" + body_id)
            $("#signvalid_pasien").val(container + "valid_pasien" + body_id)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        } else if (user_type == 1) {
            $("#signvalid_date").val(container + "valid_date" + body_id)
            $("#signvalid_user").val(container + "valid_user" + body_id)
            $("#signvalid_pasien").val(container + "valid_pasien" + body_id)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
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
                                    $("#" + formId).find(".valid_user").each(
                                        function() {
                                            $(this).val(value.sign_path)
                                        })
                                    console.log("qrcode: " + "#" + formId + "qrcode" +
                                        value.user_type)
                                    $("#" + formId + "qrcode" + value.user_type).html(
                                        "")

                                    $("#" + formId + "qrcode" + value.user_type).html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file + '" width="400px">')

                                    // let qrcode = new QRCode(document.getElementById(
                                    //     formId + "qrcode" + value.user_type), {
                                    //     text: value.sign_path,
                                    //     width: 128,
                                    //     height: 128,
                                    //     colorDark: "#000000",
                                    //     colorLight: "#ffffff",
                                    //     correctLevel: QRCode.CorrectLevel.H
                                    // });
                                    $("#" + formId + "signer" + value.user_type).html(
                                        value.fullname ?? value.user_id)
                                    console.log('Signature validity:', value.isValid);
                                } else if (value.user_type == 2) {
                                    $("#" + formId).find(".valid_pasien").each(
                                        function() {
                                            $(this).val(value.sign_path)
                                        })
                                    console.log("qrcode: " + "#" + formId + "qrcode" +
                                        value.user_type)
                                    $("#" + formId + "qrcode" + value.user_type).html(
                                        "")
                                    $("#" + formId + "qrcode" + value.user_type).html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file + '" width="400px">')

                                    // let qrcode = new QRCode(document.getElementById(
                                    //     formId + "qrcode" + value.user_type), {
                                    //     text: value.sign_path,
                                    //     width: 128,
                                    //     height: 128,
                                    //     colorDark: "#000000",
                                    //     colorLight: "#ffffff",
                                    //     correctLevel: QRCode.CorrectLevel.H
                                    // });
                                    $("#" + formId + "signer" + value.user_type).html(
                                        "<?= $visit['diantar_oleh']; ?>")
                                    console.log('Signature validity:', value.isValid);
                                } else {
                                    $("#" + formId).find(".valid_pasien").each(
                                        function() {
                                            $(this).val(value.sign_path)
                                        })
                                    console.log("qrcode: " + "#" + formId + "qrcode" +
                                        value.user_type)
                                    $("#" + formId + "qrcode" + value.user_type).html(
                                        "")
                                    $("#" + formId + "qrcode" + value.user_type).html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file + '" width="400px">')

                                    // let qrcode = new QRCode(document.getElementById(
                                    //     formId + "qrcode" + value.user_type), {
                                    //     text: value.sign_path,
                                    //     width: 128,
                                    //     height: 128,
                                    //     colorDark: "#000000",
                                    //     colorLight: "#ffffff",
                                    //     correctLevel: QRCode.CorrectLevel.H
                                    // });
                                    $("#" + formId + "signer" + value.user_type).html(
                                        "<?= $visit['diantar_oleh']; ?>")
                                    console.log('Signature validity:', value.isValid);
                                }
                            })
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


    const checkSignSignatureOperasi = async (formId, primaryKey, formSaveBtn, docs_type = null) => {

        let docData = new FormData(document.getElementById(formId))
        let signId = primaryKey
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

        // return new Promise((resolve, reject) => {
        //     $.ajax({
        //         url: '<?php echo base_url(); ?>signature/checkSignedDocsTable',
        //         type: "POST",
        //         // data: [docData, formData],
        //         data: JSON.stringify(data),
        //         dataType: 'json',
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         beforeSend: function() {},
        //         success: function(result) {
        //             try {
        //                 // Handle success
        //                 if (result.error) {
        //                     console.error('Error:', result.error);
        //                 } else {
        //                     result.forEach(item => {
        //                         const signData = item.signData;

        //                         const isMatchingFormId = signData.formId === formId;
        //                         const isMatchingDocsType = docs_type === null ||
        //                             signData.docs_type === docs_type;

        //                         if (isMatchingFormId && isMatchingDocsType) {

        //                             let qrElementId =
        //                                 `#qr-${signData.user_type}-${signId}`;

        //                             let qrElement = document.querySelector(qrElementId);

        //                             if (!qrElement) {
        //                                 console.error(
        //                                     `QR element not found: ${qrElementId}`);
        //                                 return;
        //                             }

        //                             qrElement.innerHTML = "";

        //                             if (signData.sign_path) {
        //                                 try {

        //                                     new QRCode(qrElement, {
        //                                         text: signData.sign_path,
        //                                         width: 128,
        //                                         height: 128,
        //                                         colorDark: "#000000",
        //                                         colorLight: "#ffffff",
        //                                         correctLevel: QRCode
        //                                             .CorrectLevel.H
        //                                     });
        //                                 } catch (error) {
        //                                     console.error("Error generating QR code:",
        //                                         error);
        //                                 }
        //                             } else {
        //                                 console.error("Sign path is not provided.");
        //                             }

        //                             $(`#${formSaveBtn}`).hide()
        //                         }
        //                     });
        //                 }
        //             } catch (e) {
        //                 console.error('Invalid JSON response:', e);
        //             }
        //             resolve(result);

        //         },
        //         error: function(xhr) { // if error occured
        //             console.log(xhr);
        //         },
        //         complete: function() {}
        //     });
        // })


        const localStorageData = localStorage?.getItem('testTTD');
        if (!localStorageData) {
            console.error('No signature data found in localStorage');
            return;
        }

        const parsedData = JSON.parse(localStorageData);

        parsedData.forEach(item => {
            const signData = item.signData;

            const isMatchingFormId = signData.formId === formId;
            const isMatchingDocsType = docs_type === null || signData.docs_type === docs_type;

            if (isMatchingFormId && isMatchingDocsType) {

                let qrElementId = `#qr-${signData.user_type}-${signId}`;

                let qrElement = document.querySelector(qrElementId);

                if (!qrElement) {
                    console.error(`QR element not found: ${qrElementId}`);
                    return;
                }

                qrElement.innerHTML = "";

                if (signData.sign_path) {
                    try {

                        new QRCode(qrElement, {
                            text: signData.sign_path,
                            width: 128,
                            height: 128,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    } catch (error) {
                        console.error("Error generating QR code:", error);
                    }
                } else {
                    console.error("Sign path is not provided.");
                }
            }
        });
    };



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
                errorSwal(xhr);
            },
            complete: function() {}
        });
    }
</script>

<script>
    $("#digitalSignFormDocs").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        let formData = new FormData(this)
        let formDataObject = {};
        formData.forEach(function(value, key) {
            formDataObject[key] = value
        });
        let docData = new FormData(document.getElementById($("#signopsform").val()))
        let docDataObject = {};
        docData.forEach(function(value, key) {
            docDataObject[key] = value
        });
        // let data = [];
        var data = {
            signData: formDataObject,
            docData: docDataObject
        };

        let existingData = JSON.parse(localStorage.getItem('testTTD')) || [];
        existingData?.push(data);
        localStorage.setItem('testTTD', JSON.stringify(existingData));


        let user_type = $("#signuser_type").val();

        if (user_type == '1') {
            if ($("#password").val() == '') {
                alert("Password tidak boleh kosong");
                return false;
            }
            if ($("#user_id").val() == '') {
                alert("Username tidak boleh kosong");
                return false
            }
        } else if (user_type == '2') {
            if ($("#signno_registration").val() == '') {
                alert("Nomor Rekam Medis tidak boleh kosong");
                return false
            }
            if ($("#signdatepasien").val() == '') {
                alert("Tanggal Lahir tidak boleh kosong");
                return false
            }
        } else if (user_type == '3') {
            if ($("#signname").val() == '') {
                alert("Nama tidak boleh kosong");
                return false
            }
            if ($("#signno_registration").val() == '') {
                alert("Nomor Rekam Medis pasien tidak boleh kosong");
                return false
            }
            if ($("#signdatepasien").val() == '') {
                alert("Tanggal Lahir pasien tidak boleh kosong");
                return false
            }
        }
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
                if (data.metadata.code == 200) {
                    var valid_date = $("#signvalid_date").val()
                    var valid_user = $("#signvalid_user").val()
                    var valid_pasien = $("#signvalid_pasien").val()
                    var signButton = $("#signtombolsave").val()
                    var signform = $("#signform").val()
                    var user_type = $("#signuser_type").val()
                    var container = $("#signcontainer").val()
                    var formId = $("#signform").val()
                    $("#" + formId).find("input, select, option, textarea").prop("disabled", false)
                    $("#" + signform).find(".valid-date").each(function() {
                        $(this).val(get_date())
                    })
                    if (user_type == 1)
                        $("#" + container + valid_user).val(get_bodyid())
                    // $("#" + signform).find(".valid-user").each(function() {
                    // })
                    if (user_type == 2)
                        $("#" + signform).find(".valid-pasien").each(function() {
                            $(this).val(get_bodyid())
                        })
                    if (user_type == 3)
                        $("#" + signform).find(".valid-other").each(function() {
                            $(this).val(get_bodyid())
                        })
                    $("#" + signButton).trigger("click")
                    // $("#" + valid_date).val(get_date())
                    // $("#" + valid_user).val(get_bodyid())
                    // $("#" + valid_pasien).val(get_bodyid())
                    // $("#" + signButton).trigger("click")
                    // $("#digitalSignForm").find("input").val(null)
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
        $("#digitalSignModal").modal("hide")
        checkSignSignatureOperasi(formDataObject.formId, formDataObject.sign_id, formDataObject.tombolsave,
            formDataObject.docs_type);
        $("#digitalSignModalOperation").modal("hide")
    }));

    const addSignUserOPS = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title = null, columnName = null) => {
        // if (sign_ke == 1) {
        //     $("#signopsvalid_date").val(container);
        //     $("#signopsvalid_user").val(container);
        //     $("#signopsvalid_pasien").val(container);
        //     $("#signopstombolsave").val(buttonId);
        //     $("#signopsform").val(formId);
        //     $("#signopscontainer").val(container);
        //     $("#signopsdocs_type").val(docs_type);
        //     $("#signopssign_id").val(primaryKey);
        //     $("#signopsuser_type").val(user_type);
        //     $("#signopssign_ke").val(sign_ke);
        //     $("#signopstitle").val(title);
        //     $("#signopssign_path").val('<?= user()->getFullname(); ?>: ' + get_date());
        //     $("#user_id").val("<?= user()->username; ?>");
        // }

        // $("#digitalSignModalOperation").modal("show");
        // $("#password").focus();



        console.log(formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke, title, columnName);

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);
        // if (user_type == 1) {
        //     if (columnName == null)
        //         $("#signvalid_user").val("valid_user")
        //     else
        //         $("#signvalid_user").val(columnName)
        //     $("#signvalid_pasien").val("valid_pasien")
        //     $("#signvalid_date").val("valid_date")
        //     $("#signtombolsave").val(buttonId)
        //     $("#signform").val(formId)
        //     $("#signcontainer").val(container)
        //     $("#signdocs_type").val(docs_type)
        //     $("#signsign_id").val($("#" + primaryKey).val())
        //     $("#signuser_type").val(user_type).trigger("change")
        //     $("#signsign_ke").val(sign_ke)
        //     $("#signtitle").val(title)
        //     $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        //     $("#signno_registration").val("<?= $visit['no_registration']; ?>")
        //     $("#signdatebirth").val(null)
        //     $("#user_id").val("<?= user()->username; ?>")
        // } else if (user_type == 2) {
        //     $("#signvalid_date").val(container + "valid_date")
        //     $("#signvalid_user").val(container + "valid_user")
        //     if (columnName == null)
        //         $("#signvalid_pasien").val("valid_user")
        //     else
        //         $("#signvalid_pasien").val(columnName)
        //     $("#signvalid_pasien").val(container + "valid_pasien")
        //     $("#signtombolsave").val(buttonId)
        //     $("#signform").val(formId)
        //     $("#signcontainer").val(container)
        //     $("#signdocs_type").val(docs_type)
        //     $("#signsign_id").val($("#" + primaryKey).val())
        //     $("#signuser_type").val(user_type).trigger("change")
        //     $("#signsign_ke").val(sign_ke)
        //     $("#signtitle").val(title)
        //     $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        //     $("#signno_registration").val("<?= $visit['no_registration']; ?>")
        //     $("#signdatebirth").val(null)
        //     $("#user_id").val("<?= user()->username; ?>")
        // } else {
        //     $("#signvalid_date").val(container + "valid_date")
        //     $("#signvalid_user").val(container + "valid_user")
        //     if (columnName == null)
        //         $("#signvalid_pasien").val("valid_user")
        //     else
        //         $("#signvalid_pasien").val(columnName)
        //     $("#signtombolsave").val(buttonId)
        //     $("#signform").val(formId)
        //     $("#signcontainer").val(container)
        //     $("#signdocs_type").val(docs_type)
        //     $("#signsign_id").val($("#" + primaryKey).val())
        //     $("#signuser_type").val(user_type).trigger("change")
        //     $("#signsign_ke").val(sign_ke)
        //     $("#signtitle").val(title)
        //     $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        //     $("#signno_registration").val("<?= $visit['no_registration']; ?>")
        //     $("#signdatebirth").val(null)
        //     $("#user_id").val("<?= user()->username; ?>")
        // }

        if (user_type == 1) {
            if (columnName == null)
                $("#signvalid_user").val("valid_user")
            else
                $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val("valid_pasien")
            $("#signvalid_date").val("valid_date")
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            // $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
        } else if (user_type == 2) {
            $("#signvalid_date").val(container + "valid_date")
            $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val(columnName)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            // $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
        } else {
            $("#signvalid_date").val(container + "valid_date")
            $("#signvalid_user").val(columnName)
            $("#signvalid_pasien").val(columnName)
            $("#signtombolsave").val(buttonId)
            $("#signform").val(formId)
            $("#signcontainer").val(container)
            $("#signdocs_type").val(docs_type)
            $("#signsign_id").val($("#" + primaryKey).val())
            $("#signuser_type").val(user_type).trigger("change")
            $("#signsign_ke").val(sign_ke)
            $("#signtitle").val(title)
            $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
            $("#signno_registration").val("<?= $visit['no_registration']; ?>")
            $("#signdatebirth").val(null)
            // $("#signvalue_id").val(value_id)
            $("#user_id").val("<?= user()->username; ?>")
        }

        $("#digitalSignModal").modal("show")
        $("#password").focus()
    }
</script>





<!-- ========================================================================================== -->
<script>
    $("#signuser_type").on("change", function() {
        $("#displayuser_id").hide()
        $("#displaypassword").hide()
        $("#displaysignname").hide()
        $("#displaysignno_registration").hide()
        $("#displaysigndatepasien").hide()
        $("#displaysignnik").hide()
        $("#displayttd").hide()
        if ($(this).val() == 1) {
            $("#displayuser_id").show()
            $("#displaypassword").show()
        } else if ($(this).val() == 2) {
            $("#displaysignno_registration").show()
            $("#displaysigndatepasien").show()
            $("#displayttd").show()

            let formData = new FormData(document.getElementById("digitalSignForm"))
            let formDataObject = {};
            formData.forEach(function(value, key) {
                formDataObject[key] = value
            });

            // let data = [];
            var data = {
                signData: formDataObject,
            };
            $.ajax({
                url: '<?php echo base_url(); ?>signature/getSignPict',
                type: "POST",
                // data: [docData, formData],
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // clicked_submit_btn.button('loading');
                },
                success: function(data) {

                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);

                    if (data) {
                        img.src = "data:image/gif;base64," + data.sign_file;
                        imgttd.src = "data:image/gif;base64," + data.sign_file;

                        $("#signname").val(data.fullname)

                        $("#tandatangansign").val("data:image/gif;base64," + data.sign_file);
                    }


                },
                error: function(xhr) { // if error occured
                    // alert("Error occured.please try again");
                    // clicked_submit_btn.button('reset');
                    // errorSwal(xhr);
                },
                complete: function() {
                    // clicked_submit_btn.button('reset');
                }
            });

        } else if ($(this).val() == 3) {
            $("#displaysignname").show()
            $("#displaysignno_registration").show()
            $("#displaysigndatepasien").show()
            $("#displaysignnik").show()
            $("#displayttd").show()
        }
    })
    $("#openttdmodal").on("click", function() {
        $("#tandatanganDialog").modal("show")
    })
    $("#submitttd").off().on("click", function() {
        if (canvasttd) {
            let canvasResult = canvasttd.toDataURL('image/gif');
            $("#tandatangansign").val(canvasResult);
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            img.src = canvasResult
        }
        $("#tandatanganDialog").modal("hide")
    })
    $("#signnik").blur(function() {
        let formData = new FormData(document.getElementById("digitalSignForm"))
        let formDataObject = {};
        formData.forEach(function(value, key) {
            formDataObject[key] = value
        });

        // let data = [];
        var data = {
            signData: formDataObject,
        };

        $.ajax({
            url: '<?php echo base_url(); ?>signature/getSignPict',
            type: "POST",
            // data: [docData, formData],
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // clicked_submit_btn.button('loading');
            },
            success: function(data) {



                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);

                if (data?.sign_file != '') {
                    img.src = "data:image/gif;base64," + data.sign_file;
                    imgttd.src = "data:image/gif;base64," + data.sign_file;

                    $("#signname").val(data.fullname)

                    $("#tandatangansign").val("data:image/gif;base64," + data.sign_file);
                    console.log("bisma")
                }


            },
            error: function(xhr) { // if error occured
                // alert("Error occured.please try again");
                // clicked_submit_btn.button('reset');
                // errorSwal(xhr);
            },
            complete: function() {
                // clicked_submit_btn.button('reset');
            }
        });
    })
</script>
<script>
    $("#digitalSignForm").on('submit', (function(e) {
        let user_type = $("#signuser_type").val();

        if (user_type == '1') {
            if ($("#password").val() == '') {
                alert("Password tidak boleh kosong");
                return false;
            }
            if ($("#user_id").val() == '') {
                alert("Username tidak boleh kosong");
                return false
            }
        } else if (user_type == '2') {
            if ($("#signno_registration").val() == '') {
                alert("Nomor Rekam Medis tidak boleh kosong");
                return false
            }
            if ($("#signdatepasien").val() == '') {
                alert("Tanggal Lahir tidak boleh kosong");
                return false
            }
        } else if (user_type == '3') {
            if ($("#signname").val() == '') {
                alert("Nama tidak boleh kosong");
                return false
            }
            if ($("#signno_registration").val() == '') {
                alert("Nomor Rekam Medis pasien tidak boleh kosong");
                return false
            }
            if ($("#signdatepasien").val() == '') {
                alert("Tanggal Lahir pasien tidak boleh kosong");
                return false
            }
        }


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
                if (data.metadata.code == 200) {
                    var valid_date = $("#signvalid_date").val()
                    var valid_user = $("#signvalid_user").val()
                    var valid_pasien = $("#signvalid_pasien").val()
                    var signButton = $("#signtombolsave").val()
                    var signform = $("#signform").val()
                    var user_type = $("#signuser_type").val()
                    var container = $("#signcontainer").val()
                    var formId = $("#signform").val()
                    if ($("#signdocs_type").val() === "0" || $("#signdocs_type").val() === 0) {
                        $("#" + signButton).trigger("click")
                        return
                    }

                    $("#" + formId).find("input, select, option, textarea").prop("disabled", false)

                    if (valid_user) {
                        $("#" + signform).find(".valid-date").each(function() {
                            $(this).val(get_date())
                        })
                    }
                    if (user_type == 1)
                        $("#" + container + valid_user).val(data.data)
                    // $("#" + signform).find(".valid-user").each(function() {
                    // })
                    if (user_type == 2)
                        $("#" + signform).find(".valid-pasien").each(function() {
                            $(this).val(data.data)
                        })
                    if (user_type == 3)
                        $("#" + signform).find(".valid-other").each(function() {
                            $(this).val(data.data)
                        })


                    $("#" + signButton).trigger("click")
                    // $("#" + valid_date).val(get_date())
                    // $("#" + valid_user).val(get_bodyid())
                    // $("#" + valid_pasien).val(get_bodyid())
                    // $("#" + signButton).trigger("click")
                    // $("#digitalSignForm").find("input").val(null)
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
    // const checkSignSignatureGizi = async (formId, primaryKey, formSaveBtn, docs_type = null) => {
    //     console.log();

    //     let docData = new FormData(document.getElementById(formId))
    //     let signId = primaryKey
    //     let docDataObject = {};
    //     docData.forEach(function(value, key) {
    //         docDataObject[key] = value
    //     });
    //     // let data = [];
    //     var data = {
    //         docData: docDataObject,
    //         signId: signId,
    //         docs_type: docs_type
    //     };

    //     return new Promise((resolve, reject) => {
    //         $.ajax({
    //             url: '<?php echo base_url(); ?>signature/checkSignedDocsTable',
    //             type: "POST",
    //             // data: [docData, formData],
    //             data: JSON.stringify(data),
    //             dataType: 'json',
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             beforeSend: function() {},
    //             success: function(result) {
    //                 try {
    //                     // Handle success
    //                     if (result.error) {
    //                         console.error('Error:', result.error);
    //                     } else {
    //                         result.forEach(item => {
    //                             const signData = item.signData;

    //                             const isMatchingFormId = signData.formId === formId;
    //                             const isMatchingDocsType = docs_type === null ||
    //                                 signData.docs_type === docs_type;

    //                             if (isMatchingFormId && isMatchingDocsType) {

    //                                 let qrElementId =
    //                                     #qr - $ {
    //                                         signData.user_type
    //                                     } - $ {
    //                                         signId
    //                                     };

    //                                 let qrElement = document.querySelector(qrElementId);

    //                                 if (!qrElement) {
    //                                     console.error(
    //                                         QR element not found: $ {
    //                                             qrElementId
    //                                         });
    //                                     return;
    //                                 }

    //                                 qrElement.innerHTML = "";

    //                                 if (signData.sign_path) {
    //                                     try {

    //                                         new QRCode(qrElement, {
    //                                             text: signData.sign_path,
    //                                             width: 36,
    //                                             height: 36,
    //                                             colorDark: "#000000",
    //                                             colorLight: "#ffffff",
    //                                             correctLevel: QRCode
    //                                                 .CorrectLevel.H
    //                                         });
    //                                     } catch (error) {
    //                                         console.error("Error generating QR code:",
    //                                             error);
    //                                     }
    //                                 } else {
    //                                     console.error("Sign path is not provided.");
    //                                 }

    //                                 $(#$ {
    //                                     formSaveBtn
    //                                 }).hide()
    //                             }
    //                         });
    //                     }
    //                 } catch (e) {
    //                     console.error('Invalid JSON response:', e);
    //                 }
    //                 resolve(result);

    //             },
    //             error: function(xhr) { // if error occured
    //                 console.log(xhr);
    //             },
    //             complete: function() {}
    //         });
    //     })

    // };
</script>

<script>
    const addSignUserGizi = (formId, container, primaryKey, buttonId, docs_type, user_type, sign_ke = 1, title = null) => {
        if (sign_ke == 1) {
            $("#signgizivalid_date").val(container);
            $("#signgizivalid_user").val(container);
            $("#signgizivalid_pasien").val(container);
            $("#signgizitombolsave").val(buttonId);
            $("#signgiziform").val(formId);
            $("#signgizicontainer").val(container);
            $("#signgizidocs_type").val(docs_type);
            $("#signgizisign_id").val(primaryKey);
            $("#signgiziuser_type").val(user_type);
            $("#signgizisign_ke").val(sign_ke);
            $("#signgizititle").val(title);
            $("#signgizisign_path").val('<?= user()->getFullname(); ?>: ' + get_date());
            $("#user_id").val("<?= user()->username; ?>");
        }

        $("#digitalSignModalGizi").modal("show");
        $("#passwordgizi").focus();
    }
</script>


<script>
</script>
<script>
    //INI UNTUK CANVAS PREVIEW TANDATANGAN
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('tandatangansign');
    var ctx = canvas.getContext('2d');
    var drawing = false;
    var line = []; // Store points for the current line being drawn
    let drawingHistory = [];

    var img = new Image();
    img.onload = function() {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };

    function startDrawing(e) {
        drawing = true;
        draw(e);
        line = []; // Clear the current line
        line.push({
            x: e.offsetX,
            y: e.offsetY
        }); // Add the starting point of the line
    }

    function draw(e) {
        if (!drawing) return;

        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = 'black';

        const x = e.offsetX;
        const y = e.offsetY;

        ctx.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        line.push({
            x,
            y
        }); // Add the current point to the line
    }

    function stopDrawing() {
        drawing = false;
        ctx.beginPath();
        drawingHistory.push(line);
    }
    $("#clear").on("click", function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawingHistory = []; // Clear the drawing history
        // img.onload = function() {
        //     ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        // };
        // img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;
    })
    $("#undo").on("click", function() {
        if (drawingHistory.length > 0) {
            // Remove the last line from the drawing history
            drawingHistory.pop();
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            // Redraw the remaining lines
            drawingHistory.forEach(line => {
                for (let i = 1; i < line.length; i++) {
                    ctx.beginPath();
                    ctx.moveTo(line[i - 1].x, line[i - 1].y);
                    ctx.lineTo(line[i].x, line[i].y);
                    ctx.stroke();
                }
            });
        }
    })
</script>
<script>
    //INI UNTUK CANVAS SUBMIT TANDATANGAN
    var canvasttd = document.getElementById('canvasttd');
    const canvasttdDataInput = document.getElementById('lokalisttd');
    var ctxttd = canvasttd.getContext('2d');
    var drawingttd = false;
    var ttd = []; // Store points for the current line being drawn
    let drawingHistoryttd = [];

    var imgttd = new Image();
    imgttd.onload = function() {
        ctxttd.drawImage(imgttd, 0, 0, canvasttd.width, canvasttd.height);
    };
    // console.log(img.src)

    canvasttd.addEventListener('mousedown', startDrawingttd);
    canvasttd.addEventListener('mousemove', drawttd);
    canvasttd.addEventListener('mouseup', stopDrawingttd);
    canvasttd.addEventListener('mouseout', stopDrawingttd);



    // setTimeout(function() {
    // }, )

    function startDrawingttd(e) {
        drawingttd = true;
        draw(e);
        linettd = []; // Clear the current line
        linettd.push({
            x: e.offsetX,
            y: e.offsetY
        }); // Add the starting point of the line
    }

    function drawttd(e) {
        if (!drawingttd) return;

        ctxttd.lineWidth = 2;
        ctxttd.lineCap = 'round';
        ctxttd.strokeStyle = 'black';

        const x = e.offsetX;
        const y = e.offsetY;

        ctxttd.lineTo(e.clientX - canvasttd.getBoundingClientRect().left, e.clientY - canvasttd.getBoundingClientRect().top);
        ctxttd.stroke();
        ctxttd.beginPath();
        ctxttd.moveTo(e.clientX - canvasttd.getBoundingClientRect().left, e.clientY - canvasttd.getBoundingClientRect().top);
        linettd.push({
            x,
            y
        }); // Add the current point to the line
    }

    function stopDrawingttd() {
        drawingttd = false;
        ctxttd.beginPath();
        drawingHistoryttd.push(line);
    }
    $("#clearttd").on("click", function() {
        ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);
        drawingHistoryttd = []; // Clear the drawing history
        // img.onload = function() {
        //     ctx.drawImage(img, 0, 0, canvasttd.width, canvasttd.height);
        // };
        // img.src = '<?= base_url('assets/img/asesmen') ?>' + value1.value_info;
    })
    $("#undottd").on("click", function() {
        if (drawingHistoryttd.length > 0) {
            // Remove the last line from the drawing history
            drawingHistoryttd.pop();
            // Clear the canvasttd
            ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);
            // Redraw the remaining lines
            drawingHistoryttd.forEach(linettd => {
                for (let i = 1; i < linettd.length; i++) {
                    ctxttd.beginPath();
                    ctxttd.moveTo(linettd[i - 1].x, linettd[i - 1].y);
                    ctxttd.lineTo(linettd[i].x, linettd[i].y);
                    ctxttd.stroke();
                }
            });
        }
    })
</script>