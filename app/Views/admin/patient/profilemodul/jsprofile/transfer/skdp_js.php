<script>
    const setDataSkdp = async (data = null) => {
        <?php if ($visit['isrj'] == 0) {
        ?>
            $("#skdpnosep").val('<?= $visit['no_skpinap']; ?>')
        <?php
        } else {
        ?>
            $("#skdpnosep").val('<?= $visit['no_skp']; ?>')
        <?php
        } ?>


        $("#skdpkddpjp").val($("#atransferemployee_id").val())

        <?php if ($visit['isrj'] == '0') {
        ?>
            $("#skdpkdpoli").val('<?= $visit['clinic_id_from']; ?>')
        <?php
        } else {
        ?>
            $("#skdpkdpoli").val('<?= $visit['clinic_id']; ?>')
        <?php
        } ?>
        flatpickrInstances["flatskdptglkontrol"] =
            flatpickr("#flatskdptglkontrol", {
                dateFormat: "d/m/Y", // Hanya menampilkan tanggal tanpa waktu
                minDate: new Date().fp_incr(-12), // Rentang tanggal minimal 3 hari ke depan
                defaultDate: new Date().fp_incr(30), // Default tanggal adalah 7 hari ke depan
            });
        $("#flatskdptglkontrol").prop("readonly", false);

        $("#flatskdptglkontrol").on("change", function() {
            let theid = "skdptglkontrol";
            let thevalue = $(this).val();
            let formattedDate = moment(thevalue, "DD/MM/YYYY").format(
                "YYYY-MM-DD"
            );
            $("#" + theid)
                .val(formattedDate)
                .trigger("change");
        })
        $("#flatskdptglkontrol").trigger("change");

        $("#skdpkddpjp").val('<?= $visit['employee_id']; ?>')

        $("#skdpnosurat").val(null)
        $("#skdpnoskdp_rs").val(null)

        const req = await libAsyncAwaitPost({
                visit: '<?= $visit['visit_id']; ?>',
                nosurat: $("#atransferdocument_id").val()
            },
            "admin/rm/assessment/getKontrol"
        );


        console.log(req)
        console.log(req.data)
        console.log(req?.data?.length)
        if (req?.data?.nosep) {
            $("#skdpnosep").val(req?.data?.nosep)
            $("#skdpkddpjp").val(req?.data?.kodedokter)
            $("#skdpkdpoli").val(req?.data?.clinic_id)
            flatpickrInstances["flatskdptglkontrol"].setDate(formatedDatetimeFlat(req?.data?.tglrenckontrol))
            $("#skdptglkontrol").val(req?.data?.tglrenckontrol)
            $("#skdpnosurat").val(req?.data?.nosuratkontrol)
            $("#skdpnoskdp_rs").val(req?.data?.noskdp_rs)
        }
        $("#atransferskdpgroup").slideDown()
    }

    const getSKDP = () => {
        $("#getSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

        var currentkey = $("#pvcurrentkey").val()
        var currentClinic = $("#pvclinic_id").val()
        var selectedVisit = ''
        skunjAll.forEach((element, key) => {
            if (key < currentkey && element.clinic_id == currentClinic)
                selectedVisit = element.visit_id
        })

        postData({
            'norm': '<?= $visit['no_registration']; ?>',
            'kddpjp': $("#pvkddpjp").val(),
            'clinic_id': currentClinic,
            'visit_id': '<?= $visit['visit_id']; ?>'
        }, 'admin/pendaftaran/getSKDP', (res) => {
            if (res.metadata.code == '200') {
                alert('Berhasil mengambil data SKDP')
            } else {
                alert('tidak ada data SKDP')
            }
            $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        });
        // $.ajax({
        //     url: '<?php echo base_url(); ?>admin/pendaftaran/getSKDP',
        //     type: "POST",
        //     data: JSON.stringify({
        //         'norm': '<?= $visit['no_registration']; ?>',
        //         'kddpjp': $("#pvkddpjp").val(),
        //         'clinic_id': currentClinic,
        //         'visit_id': '<?= $visit['visit_id']; ?>'
        //     }),
        //     dataType: 'json',
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {
        //         if (data.metadata.code == '200') {
        //             alert('Berhasil mengambil data SKDP')
        //             $("#pvedit_sep").val(data.skdp)
        //         } else {
        //             alert('tidak ada data SKDP')
        //         }
        //         $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        //     },
        //     error: function() {
        //         $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
        //     }
        // });
    }

    const saveSkdp = () => {
        let skdpnosep = $("#skdpnosep").val()
        let skdpkddpjp = $("#skdpkddpjp").val()
        let skdpkdpoli = $("#skdpkdpoli").val()
        let skdptglkontrol = $("#skdptglkontrol").val()
        let skdpnosurat = $("#skdpnosurat").val()
        let skdpnoskdp_rs = $("#atransferdocument_id").val()
        // let skdpnoskdp_rs = $("#skdpnoskdp_rs").val()

        if (skdpkddpjp == '' || skdpkddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (skdpkdpoli == '' | skdpkdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (skdptglkontrol == '' || skdptglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            let formtransfer = new FormData(document.getElementById("formaddatransfer"))
            let formtransferarray = {}
            formtransfer.forEach(function(value, key) {
                formtransferarray[key] = value
            });
            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/saveSkdp',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noSEP": skdpnosep,
                        "kodeDokter": skdpkddpjp,
                        "poliKontrol": skdpkdpoli,
                        "tglRencanaKontrol": skdptglkontrol,
                        "user": '<?= user()->username; ?>'
                    },
                    "visit_id": '<?= $visit['visit_id']; ?>',
                    "noSuratKontrol": skdpnosurat,
                    'no_registration': '<?= $visit['no_registration']; ?>',
                    'transfer': formtransferarray,
                    'noskdp_rs': skdpnoskdp_rs
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    console.log(data?.metaData?.code)
                    console.log(data?.response?.noSuratKontrol)
                    let nosuratkontrol = data?.response?.nosuratkontrol
                    let noskdp_rs = data?.response?.noskdp_rs
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting SKDP!")
                        $("#skdpnosurat").val(data?.response?.noSuratKontrol)
                        $("#skdpnoskdp_rs").val(data?.data?.noskdp_rs)
                    } else {
                        alert('Bridging BPJS: ' + data?.metaData?.message)
                        $("#skdpnoskdp_rs").val(data?.data?.noskdp_rs)
                    }
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    const deleteSkdp = () => {
        var skdpnosurat = $("#skdpnosurat").val()
        if (skdpnosurat == '' || skdpnosurat == null) {
            alert('Kolom Nomor SKDP tidak boleh kosong saat menghapus')
        } else {
            $("#deleteSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/deleteSkdp',
                type: "DELETE",
                data: JSON.stringify({
                    "request": {
                        "t_suratkontrol": {
                            "noSuratKontrol": skdpnosurat,
                            "user": '<?= user()->username; ?>'
                        }
                    }
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil delete SKDP!")
                        $("#skdpnosurat").val("")
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#deleteSkdpBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                },
                error: function() {
                    $("#deleteSkdpBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                }
            });
        }
    }

    const checkSkdp = () => {
        $("#checkSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var skdpnosurat = $("#skdpnosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSkdp',
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
                    var skdp = data.data
                    $("#skdpnosep").val(skdp.nosep)
                    $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#skdpkdpoli").html("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            $("#skdpkdpoli").append(new Option(value[2], value[0]))
                            console.log(value[2])
                        }
                    })
                    $("#skdptglkontrol").val((String)(skdp.tglrenckontrol).slice(0, 10))
                    $("#skdpnosurat").val(skdp.nosuratkontrol)
                    // Object.keys(dpjp).forEach(key => {
                    //     if (key == employeeSelected) {
                    //         // console.log(key, dpjp[key]);
                    //         $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                    //         $("#skdpkddpjp").html("")
                    //         $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    //     }
                    // });
                } else {
                    alert(data.metadata.message)
                    $("#skdpnosep").val($("#pvno_skp").val())
                    $("#skdpkddpjp").html("")
                    $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    $("#skdpkdpoli").html("")
                    klinikBpjs.forEach((value, key) => {
                        if (value[1] == $("#pvclinic_id").val()) {
                            $("#skdpkdpoli").append(new Option(value[2], value[0]))
                            console.log(value[2])
                        }
                    })
                    $("#skdptglkontrol").val(null)
                    $("#skdpnosurat").val("")
                }
                $("#checkSkdpBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            },
            error: function() {
                $("#checkSkdpBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            }
        });
    }
</script>