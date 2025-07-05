<script>
    $("#riwayatPasienTab").on("click", () => {
        getRiwayatPasien()
        enableRiwayatPasien()
    })

    const getRiwayatPasien = () => {
        postData({
            no_registration: visit?.no_registration
        }, 'admin/riwayatpasien/getData', (res) => {
            riwayatAll = res
            fillRiwayatPasien()
            // enableRiwayatPasien()
        }, () => {
            getLoadingscreen("contentRiwayatPasien", "loadContentRiwayatPasien")
        })
    }

    const saveRiwayatPasien = () => {
        postDataForm(
            new FormData(document.getElementById("formRiwayatPasien")),
            'admin/riwayatpasien/postData', (res) => {
                getRiwayatPasien()
                disableRiwayatPasien()
            }, () => {

            }
        )
    }

    const updateCheckRiwayatPasien = (id) => {
        postData({
            no_registration: visit?.no_registration,
            org_unit_code: visit?.org_unit_code,
            value_id: $("#" + id).prop("name"),
            ischecked: $("#" + id).prop("checked")
        }, 'admin/riwayatpasien/updateCheckRiwayatPasien', (res) => {
            console.log("berhasil update riwayat pasien: " + value_id)
        }, () => {})
    }


    const fillRiwayatPasien = () => {
        $.each(riwayatAll, function(key, value) {
            if ($("#rwytGEN0009" + value.value_id).is(":checkbox")) {
                $("#rwytGEN0009" + value.value_id).prop("checked", true)
            } else {
                $("#rwytGEN0009" + value.value_id).val(value.histories)
            }
            $("#rwytno_registration").val(visit.no_registration)
            $("#rwytorg_unit_code").val(visit.org_unit_code)
        })
    }

    const enableRiwayatPasien = () => {
        $("#formRiwayatPasien").find("input, textarea").each(() => {
            $(this).prop("disabled", false)
        })
        $("#formRiwayatPasienSaveBtn").show()
        $("#formRiwayatPasienEditBtn").hide()
    }

    const disableRiwayatPasien = () => {
        $("#formRiwayatPasien").find("input, textarea").each(() => {
            $(this).prop("disabled", true)
        })
        $("#formRiwayatPasienSaveBtn").hide()
        $("#formRiwayatPasienEditBtn").show()
    }
</script>