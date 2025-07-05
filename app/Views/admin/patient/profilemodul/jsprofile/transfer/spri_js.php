<script>
    const setDataSpri = async (data = null) => {


        $("#spritglkontrol").val(get_date())
        $("#sprinosurat").val(null)
        flatpickrInstances["flatspritglkontrol"] =
            flatpickr("#flatspritglkontrol", {
                dateFormat: "d/m/Y", // Hanya menampilkan tanggal tanpa waktu
                // minDate: new Date().fp_incr(3), // Rentang tanggal minimal 3 hari ke depan
                // defaultDate: new Date().fp_incr(30), // Default tanggal adalah 7 hari ke depan
            });
        $('#sprikddpjp').select2({
            width: '100%', // Make it fit the container
            placeholder: 'Select a doctor', // Placeholder text
            allowClear: true // Allow clearing selection
        });
        $("#flatspritglkontrol").on("change", function() {
            let theid = "spritglkontrol";
            let thevalue = $(this).val();
            let formattedDate = moment(thevalue, "DD/MM/YYYY").format(
                "YYYY-MM-DD"
            );
            $("#" + theid)
                .val(formattedDate)
                .trigger("change");
        })
        flatpickrInstances["flatspritglkontrol"].setDate(moment().format("DD/MM/YYYY"))
        $("#flatspritglkontrol").trigger("change")


        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>',
                nosurat: $("#atransferdocument_id").val()
            },
            "admin/rm/assessment/getSPRI"
        );


        if (req?.data) {
            $("#sprikddpjp").val(req?.data?.kodedokter).trigger("change")
            $("#sprikdpoli").val(req?.data?.clinic_id)
            $("#spritglkontrol").val(req?.data?.tglrenckontrol)
            $("#sprinosurat").val(req?.data?.nosuratkontrol)
            $("#sprinoskdp_rs").val(req?.data?.noskdp_rs)
            console.log(req?.data?.tglrenckontrol)
            flatpickrInstances["flatspritglkontrol"].setDate(formatedDatetimeFlat(req?.data?.tglrenckontrol))
            $("#flatspritglkontrol").trigger("change")
        } else {
            $("#sprikddpjp").val($("#atransferemployee_id").val())

            $("#sprikdpoli").val('<?= $visit['clinic_id']; ?>')
        }
        console.log($("#sprikddpjp").val())
        console.log($("#sprikdpoli").val())
        $("#atransfersprigroup").slideDown()
    }

    // const getSPRI = () => {
    //     $("#getSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //     $("#getSpriSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
    //     // alert("Get Nomor SKDP Berhasil")
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/pendaftaran/getSPRI',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'norm': $visit['no_registration'],
    //             'kddpjp': $visit['kddpjp'],
    //             'clinic_id': $visit['clinic_id'],
    //             'visit_id': $visit['visit_id']
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {
    //             if (data.metadata.code == '200') {
    //                 alert('Berhasil mengambil data SPRI')
    //                 $("#pvspecimenno").val(data.spri)
    //                 $("#taspecimenno").val(data.spri)
    //             } else {
    //                 alert('tidak ada data SPRI')
    //             }
    //             $("#getSpriBtn").html('<i class="fa fa-search"></i>')
    //             $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
    //         },
    //         error: function() {
    //             $("#getSpriBtn").html('<i class="fa fa-search"></i>')
    //             $("#getSpriRanapBtn").html('<i class="fa fa-search"></i>')
    //         }
    //     });
    // }

    const saveSpri = () => {
        let spripasien_id = '<?= $visit['pasien_id']; ?>'
        let sprikddpjp = $("#sprikddpjp").val()
        let sprikdpoli = $("#sprikdpoli").val()
        let spritglkontrol = $("#spritglkontrol").val()
        spritglkontrol = spritglkontrol.substring(0, 10)
        let sprinosurat = $("#sprinosurat").val()
        let sprinoskdp_rs = $("#atransferdocument_id").val()
        // let sprinoskdp_rs = $("#sprinoskdp_rs").val()

        // if (spripasien_id == '') {
        //     if ('<?= $visit['status_pasien_id']; ?>' == '18')
        //         alert('No Kartu BPJS harus diisi!')
        // } else 
        if (sprikddpjp == '' || sprikddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (sprikdpoli == '' | sprikdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (spritglkontrol == '' || spritglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            let formtransfer = new FormData(document.getElementById("formaddatransfer"))
            let formtransferarray = {}
            formtransfer.forEach(function(value, key) {
                formtransferarray[key] = value
            });
            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSpri',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noKartu": spripasien_id,
                        "kodeDokter": sprikddpjp,
                        "poliKontrol": sprikdpoli,
                        "tglRencanaKontrol": spritglkontrol,
                        "user": '<?= user()->username; ?> ',
                    },
                    "visit_id": '<?= $visit['visit_id']; ?>',
                    "noSuratKontrol": sprinosurat,
                    'noskdp_rs': sprinoskdp_rs,
                    'no_registration': '<?= $visit['no_registration']; ?>',
                    'transfer': formtransferarray
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting spri!")
                        $("#sprinosurat").val(data?.response.noSPRI)
                        $("#atransferdocument_id").val(data?.data?.noskdp_rs)
                        $("#sprinoskdp_rs").val(data?.data?.noskdp_rs)
                    } else {
                        alert('Bridging BPJS: ' + data?.metaData?.message)
                        $("#sprinoskdp_rs").val(data?.data?.noskdp_rs)

                    }
                    $("#saveSpriBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSpriBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    const deleteSpri = () => {
        var sprinosurat = $("#sprinosurat").val()
        if (sprinosurat == '' || sprinosurat == null) {
            alert('Kolom Nomor spri tidak boleh kosong saat menghapus')
        } else {
            $("#deletespriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/deletespri ',
                type: "DELETE",
                data: JSON.stringify({
                    "request": {
                        "t_suratkontrol": {
                            "noSuratKontrol": sprinosurat,
                            "user": '<?= user()->username; ?> '
                        }
                    }
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data?.metaData?.code == '200') {
                        alert("Berhasil delete spri!")
                        $("#sprinosurat").val("")
                    } else {
                        alert(data?.metaData?.message)
                    }
                    $("#deletespriBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                },
                error: function() {
                    $("#deletespriBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                }
            });
        }
    }

    const checkSpri = () => {
        $("#checkspriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var sprinosurat = $("#sprinosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSpri ',
            type: "POST",
            data: JSON.stringify({
                "visit": '<?= $visit['visit_id']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert(data.metadata.message)
                    var spri = data.data
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#sprikddpjp").val($("#pvkddpjp").val())
                    $("#sprikdpoli").val("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            // $("#sprikdpoli").append(new Option(value[2], value[0]))
                            $("#sprikdpoli").val(value[0])
                            // console.log(value[2])
                        }
                    })
                    $("#spritglkontrol").val((String)(spri.tglrenckontrol).slice(0, 10))
                    $("#sprinosurat").val(spri.nosuratkontrol)
                    // Object.keys(dpjp).forEach(key => {
                    // if (key == employeeSelected) {
                    // // console.log(key, dpjp[key]);
                    // $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                    // $("#sprikddpjp").val("")
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    // }
                    // });
                } else {
                    alert(data.metadata.message)
                    $("#sprikddpjp").val("")
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#sprikddpjp").val($("#pvkddpjp").val())
                    $("#sprikdpoli").val("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            // $("#sprikdpoli").append(new Option(value[2], value[0]))
                            $("#sprikdpoli").val(value[0])
                            // console.log(value[2])
                        }
                    })
                    $("#spritglkontrol").val(null)
                    $("#sprinosurat").val("")
                }
                $("#checkspriBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            },
            error: function() {
                $("#checkspriBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            }
        });
    }
</script>