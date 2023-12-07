<?php
$session = session();
$gsPoli = $session->gsPoli;
$permissions = user()->getPermissions();
// dd(isset($permissions['pendaftaranrajal']['c']));
?>
<script type="text/javascript">
    var tableRajal = $("#tableSearchRajal").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    var tableHistoryRajal = $("#historyRajalTable").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    $(document).ready(function(e) {
        <?php if ($gsPoli != '') { ?>
            $("#klinikrajal").val('<?= $gsPoli; ?>')
        <?php } ?>
        $("#form1btn").trigger('click')
    })
    $("#form1").on('submit', (function(e) {
        e.preventDefault();
        $("#form1btn").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopddatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableRajal.clear().draw()
                data.data.forEach((element, key) => {
                    // stringcolumn += '<tr class="table tablecustom-light">';
                    // element.forEach((element1, key1) => {
                    //     stringcolumn += "<td>" + element1 + "</td>";
                    // });
                    // stringcolumn += '</tr>'
                    tableRajal.row.add(element).draw()
                });
                $("#form1btn").html('<i class="fa fa-search"></i> Cari')
            },
            error: function() {
                errorMsg('Data terlalu besar, silahkan persempit range tanggal atau ubah filter menjadi lebih spesifik')
                $("#form1btn").html('<i class="fa fa-search"></i>')
            }
        });

    }));
</script>

<script>
    $("#formpv").on('submit', (function(e) {
        $("#formaddpvbtn").html('<i class="spinner-border spinner-border-sm"></i>')
        e.preventDefault();


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addvisit',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#formaddpvbtn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    alert(message);
                } else {
                    alert(data.message);
                    disableFormPv()
                    var skunj = data.data
                    var currentKey = (Number)($("#pvcurrentkey").val())
                    skunjAll[currentKey] = skunj
                    viewKunjunganOnModal(0, currentKey)
                }
                $("#formaddpvbtn").html('<i class="fa fa-check-circle"></i><?php echo lang('save'); ?>')
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#formaddpvbtn").html('<i class="fa fa-check-circle"></i><?php echo lang('save'); ?>')
            },
            complete: function() {
                $("#formaddpvbtn").html('<i class="fa fa-check-circle"></i><?php echo lang('save'); ?>')
            }
        });
    }));

    function deleteFormPV() {
        $("#formdelpvbtn").html('<i class="spinner-border spinner-border-sm"></i>')

        var start = new Date($("#pvvisit_date").val())
        var end = new Date()

        var daydiff = datediff(start, end)

        if (daydiff < 3) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletevisit',
                type: "POST",
                data: new FormData(document.getElementById('formpv')),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var currentkey = $("#pvcurrentkey").val()
                    skunjAll.splice(currentkey, 1)
                    viewKunjunganOnModal(0, skunjAll.length - 1)
                    $("#formdelpvbtn").html('<i class="fa fa-trash"></i>Delete')
                },
                error: function() {
                    $("#formdelpvbtn").html('<i class="fa fa-trash"></i>Delete')
                }
            });
        } else {
            alert("Kunjungan telah melebihi batas waktu pengeditan. Silahkan hubungi petugas administrator!")
            disableFormPv()
        }
    }

    function editFormPV() {
        var start = new Date($("#pvvisit_date").val())
        var end = new Date()

        var daydiff = datediff(start, end)

        if (daydiff < 3) {
            enableFormPV()
        } else {
            alert("Kunjungan telah melebihi batas waktu pengeditan. Silahkan hubungi petugas administrator!")
            disableFormPv()
        }
    }

    function get_PatientDetailspv(id) {
        var base_url = "<?php echo base_url(); ?>backend/images/loading.gif";
        $("#ajax_load").html("<center><img src='" + base_url + "'/>");
        if (id == '') {
            $("#ajax_load").html("");
            $("#patientDetails").hide();
        } else {
            $.ajax({
                url: baseurl + 'admin/patient/getpatientDetails',
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $("#ajax_load").html("");
                        $("#patientDetails").show();
                        resetModal();
                        sbio = data
                        if (data.ismeninggal == 0) {
                            var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                        } else {
                            var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                        }
                        $("patientid").val(data.no_registration);
                        $(".identityPv").html(data.name_of_pasien + " (" + data.no_registration + ")");

                        $("#biodatapvkk_no").html(data.KK_NO);
                        coverage.forEach((element, index) => {
                            if (index == data.coverage_id) {
                                $("#biodatapvcoverages").html(element);
                            }
                        });
                        $("#pvpasien_id").html(data.kk_no);
                        kelas.forEach(value => {
                            if (value[0] == data.class_id) {
                                $("#biodatapvclass_id").html(value[1]);
                            }
                        });
                        $("#biodatapvplacebirth").html(data.place_of_birth);
                        $("#biodatapvdatebirth").html(data.date_of_birth.substring(0, 10));
                        $("#biodatapvage").html(data.patient_age);
                        $("#biodatapvdescription").html(data.description);
                        $("#biodatapvaddress").html(data.contact_address);
                        $("#biodatapvrtrw").html(data.rt + " / " + data.rw);
                        // kalurahan.forEach(kalvalue => {
                        //     if (sbio.kal_id == kalvalue[0]) {
                        //         $("#pvkalurahan").html(kalvalue[1]);
                        //         kecamatan.forEach(kecvalue => {
                        //             if (kecvalue[0] == kalvalue[2]) {
                        //                 $("#pvkecamatan").html(kecvalue[1]);
                        //                 kota.forEach(kotavalue => {
                        //                     if (kecvalue[2] == kotavalue[1]) {
                        //                         $("#pvkota").html(kotavalue[2]);
                        //                         prov.forEach(provvalue => {
                        //                             if (provvalue[0] == kotavalue[0]) {
                        //                                 $("#pvprov").html(provvalue[2]);
                        //                             }
                        //                         })
                        //                     }

                        //                 });
                        //             }
                        //         });
                        //     }
                        // })

                        $("#biodatapvphone").html(data.phone_number + " / " + data.mobile);
                        statusPasien.forEach(value => {
                            if (value[0] == data.status_pasien_id) {
                                $("#pvstatus").html(value[1]);
                            }
                        });
                        payor.forEach(payorvalue => {
                            if (payorvalue[1] == data.payor_id) {
                                $("#biodatapvpayor").html(payorvalue[3]);
                            }
                        });

                        $("#biodatapvayah").html(data.father);
                        $("#biodatapvibu").html(data.mother);
                        $("#biodatapvsutri").html(data.spouse);
                        education.forEach(value => {
                            if (value[0] == data.education_type_code) {
                                $("#biodatapvedukasi").html(value[1]);
                            }
                        });
                        job.forEach(jobvalue => {
                            if (jobvalue[0] == data.job_id) {
                                $("#biodatapvpekerjaan").html(jobvalue[1]);
                            }
                        });
                        blood.forEach(bloodvalue => {
                            if (bloodvalue[1] == data.blood_type_id) {
                                $("#biodatapvgoldar").html(bloodvalue[0]);
                            }
                        });
                        agama.forEach(agamavalue => {
                            if (agamavalue[0] == data.kode_agama) {
                                $("#biodatapvagama").html(agamavalue[1]);
                            }
                        });
                        marital.forEach(maritalvalue => {
                            if (maritalvalue[0] == data.maritalstatusid) {
                                $("#biodatapvperkawinan").html(maritalvalue[1]);
                            }
                        });
                        gender.forEach(gendervalue => {
                            if (gendervalue[0] == data.gender) {
                                $("#biodatapvgender").html(gendervalue[1]);
                            }
                        });
                        family.forEach(value => {
                            if (value[0] == data.family_status_id) {
                                $("#pvfamily").html(value[1]);
                            }
                        });


                        $("#pvemployee_id").html("");
                        var clinicSelected = 'P003';
                        dokterdpjp.forEach((value, key) => {
                            if (value[0] == clinicSelected) {
                                $("#pvemployee_id").append(new Option(value[2], value[1]));
                            }
                        })


                        $("#pvdiantar_oleh").val(sbio.name_of_pasien);
                        $("#pvno_registration").val(sbio.no_registration);
                        $("#pvvisitor_address").val(sbio.visitor_address);
                        $("#pvorg_unit_code").val(sbio.org_unit_code);
                        $("#pvtgl_lahir").val(sbio.date_of_birth);
                        $("#pvgender").val(sbio.gender);
                        $("#pvpayor_id").val(sbio.payor_id);
                        $("#pvclinic_id_from").val("P000");
                        $("#pvclass_id_plafond").val(sbio.class_id);
                        $("#pvclass_id").val(sbio.class_id);
                        $("#pvbooked_date").val((get_date()).slice(0, 16));
                        $("#pvvisit_date").val((get_date()).slice(0, 16));
                        $("#pvstatus_pasien_id").val(sbio.status_pasien_id);
                        $("#pvclinic_id_from").val('P000');
                        $("#pvtanggal_rujukan").val(null);
                        $("#pvpasien_id").val(sbio.kk_no);
                        var age = getAge(sbio.date_of_birth);
                        $("#pvageyear").val(age.years)
                        $("#pvagemonth").val(age.month)
                        $("#pvageday").val(age.days)
                        $("#pvcoverage_id").val(sbio.coverage_id)
                        $("#pvagama").val(sbio.kode_agama)
                        $("#pvaktif").val(sbio.aktif)
                        $("#pvfamily_status_id").val(sbio.family_status_id)

                        $("#pvkdpoli_eks").val(0)
                        $("#pvisnew").val(0)
                        $("#pvcob").val(0)
                        $("#pvway_id").val(17)
                        $("#pvisattended").val(0)
                        $("#pvbackcharge").val(0)
                        $("#pvisrj").val(1);
                        $("#pvreason_id").val(0)


                        $("#formaddpvbtn").removeProp("disabled")
                        $("#formaddpvbtn_save_print").removeProp("disabled")


                        $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
                    } else {
                        $("#ajax_load").html("");
                        $("#patientDetails").hide();
                    }

                    // holdModal('rincianPasienModel');
                    // patientvisit(data.no_registration);
                },
            });
        }

    }
</script>

<script type="text/javascript">
    $("#pvclinic_id").on("click", function() {
        $("#pvemployee_id").html("");
        $("#pvkddpjp").html("");
        var clinicSelected = $("#pvclinic_id").val();
        dokterdpjp.forEach((value, key) => {
            if (value[0] == clinicSelected) {
                $("#pvemployee_id").append(new Option(value[2], value[1]));
            }

        })
        var employeeSelected = $("#pvemployee_id option:selected").val()
        Object.keys(dpjp).forEach(key => {
            if (key == employeeSelected) {
                // console.log(key, dpjp[key]);
                $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                $("#skdpkddpjp").html("")
                $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
            }
        });

        $("#skdpkdpoli").html("")
        klinikBpjs.forEach((value, key) => {
            if (value[1] == clinicSelected) {
                $("#skdpkdpoli").append(new Option(value[2], value[0]))
                console.log(value[2])
            }
        })
    });
    $("#pvemployee_id").on("click", function() {
        $("#pvkddpjp").html("");
        var dokterSelected = $("#pvemployee_id").val();
        Object.keys(dpjp).forEach(key => {
            if (key == dokterSelected) {
                // console.log(key, dpjp[key]);
                $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                $("#skdpkddpjp").html("")
                $("#skdpkddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
            }
        });
    });

    function getRujukan() {
        var norujukan = $("#pvnorujukan").val()
        var nokartu = $("#pvpasien_id").val()
        var asalrujukan = $("#pvasalrujukan").val()
        if (asalrujukan == '') {
            alert("Pilih Asal Rujukan")
        } else {

        }

        $("#getRujukanBtn").html('<i class="spinner-border spinner-border-sm"></i>')

        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getRujukan',
            type: "POST",
            data: JSON.stringify({
                'norujukan': norujukan,
                'nokartu': nokartu,
                'asalrujukan': asalrujukan
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metaData.code == '200') {
                    alert("Get Rujukan Berhasil")
                    $("#pvnorujukan").val(data.response.rujukan.noKunjungan)
                    $("#pvkdpoli").val(data.response.rujukan.poliRujukan.kode)
                    $("#pvtanggal_rujukan").val(data.response.rujukan.tglKunjungan)
                    $("#pvppkrujukan").val(data.response.rujukan.provPerujuk.kode)
                    $("#pvdiag_awal").html("")
                    $("#pvdiag_awal").append(new Option(data.response.rujukan.diagnosa.nama, data.response.rujukan.diagnosa.kode))
                    $("#pvconclusion").val(data.response.rujukan.diagnosa.nama)
                } else {
                    alert(data.metaData.message)
                }
                $("#getRujukanBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#getRujukanBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
            },
            complete: function() {
                $("#getRujukanBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
            }
        })
        // alert("Get Rujukan Berhasil")
        // $("#pvnorujukan").val('0097R0090520B000006')
        // $("#pvkdpoli").val('INT')
        // $("#pvtanggal_rujukan").val('2020-05-19 00:00:00.000')
        // $("#pvppkrujukan").val('0097B011')
    }

    function insertSep() {
        var clicked_submit_btn = $("#createSepBtn")

        var kdpoli = ''
        var clinicSelected = $("#pvclinic_id").val()
        klinikBpjs.forEach((value, key) => {
            if (value[1] == clinicSelected) {
                kdpoli = value[0]
                // $("#skdpkdpoli").append(new Option(value[2], value[0]))
                // console.log(value[2])
            }
        })

        if ($("#pvedit_sep").val() == '' || $("#pvedit_sep").val() == null) {
            alert("Nomor SKDP tidak boleh kosong")
        } else {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/insertSep',
                type: "POST",
                data: JSON.stringify({
                    'noKartu': $("#pvpasien_id").text(),
                    "tglSep": (String)($("#pvvisit_date").val()).slice(0, 10),
                    "ppkPelayanan": '<?= $orgunit['OTHER_CODE']; ?>',
                    "jnsPelayanan": ($("#pvisrj").val() == 1 ? 2 : 1),
                    "klsRawat": {
                        "klsRawatHak": $("#pvclass_id_plafond").val(),
                        "klsRawatNaik": $("#pvclass_id").val(),
                        "pembiayaan": "1",
                        "penanggungJawab": "Pribadi"
                    },
                    "noMR": $("#pvno_registration").val(),
                    "rujukan": {
                        "asalRujukan": $("#pvasalrujukan").val(),
                        "tglRujukan": $("#pvtanggal_rujukan").val(),
                        "noRujukan": $("#pvnorujukan").val(),
                        "ppkRujukan": $("#pvppkrujukan").val()
                    },
                    "catatan": $("#pvdescription").val(),
                    "diagAwal": $("#pvdiag_awal").val(),
                    "poli": {
                        "tujuan": kdpoli,
                        "eksekutif": $("#pvkdpoli_eks").val()
                    },
                    "cob": {
                        "cob": $("#pvcob").val()
                    },
                    "katarak": {
                        "katarak": $("#pvbackcharge").val()
                    },
                    "jaminan": {
                        "lakaLantas": ($("#pvreason_id") == 3 ? 1 : 0),
                        "noLP": $("#pvtemptrans").val(),
                        "penjamin": {
                            "tglKejadian": $("#pvvalid_rm_date").val(),
                            "keterangan": $("#pvdelete_sep").val(),
                            "suplesi": {
                                "suplesi": $("#pvispertarif").val(),
                                "noSepSuplesi": $("#pvno_skp").val(),
                                "lokasiLaka": {
                                    "kdPropinsi": "",
                                    "kdKabupaten": "",
                                    "kdKecamatan": ""
                                }
                            }
                        }
                    },
                    "tujuanKunj": $("#pvtujuankunj").val(),
                    "flagProcedure": $("#pvflagprocedure").val(),
                    "kdPenunjang": $("#pvkdpenunjang").val(),
                    "assesmentPel": $("#pvassesmentpel").val(),
                    "skdp": {
                        "noSurat": $("#pvedit_sep").val(),
                        "kodeDPJP": $("#pvkddpjp").val()
                    },
                    "dpjpLayan": ($("#pvisrj").val() == 1 ? $("#pvkddpjp").val() : ""),
                    "noTelp": sbio.mobile,
                    "user": '<?= user()->username; ?>'
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#createSepBtn").html('<i class="spinner-border spinner-border-sm"></i>')
                },
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("insert SEP Berhasil")
                        var result = data.response.sep
                        $("#pvno_skp").val(result.noSep)
                        $("#responpost_vklaim").val(JSON.stringify(data))
                        $("#formaddpvbtn").click()
                    } else {
                        alert(data.metaData.message)
                    }
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $("#createSepBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>');
                },
                complete: function() {
                    $("#createSepBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>');
                }
            })
        }
    }

    function editSep() {
        var clicked_submit_btn = $("#editSepBtn")


        var kdpoli = ''
        var clinicSelected = $("#pvclinic_id").val()
        klinikBpjs.forEach((value, key) => {
            if (value[1] == clinicSelected) {
                kdpoli = value[0]
                // $("#skdpkdpoli").append(new Option(value[2], value[0]))
                // console.log(value[2])
            }
        })

        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/editSep',
            type: "PUT",
            data: JSON.stringify({
                'noSep': $("#pvno_skp").text(),
                "jnsPelayanan": ($("#pvisrj").val() == 1 ? 2 : 1),
                "klsRawat": {
                    "klsRawatHak": $("#pvclass_id_plafond").val(),
                    "klsRawatNaik": $("#pvclass_id").val(),
                    "pembiayaan": "1",
                    "penanggungJawab": "Pribadi"
                },
                "noMR": $("#pvno_registration").val(),
                "catatan": $("#pvdescription").val(),
                "diagAwal": $("#pvdiag_awal").val(),
                "poli": {
                    "tujuan": kdpoli,
                    "eksekutif": $("#pvkdpoli_eks").val()
                },
                "cob": {
                    "cob": $("#pvcob").val()
                },
                "katarak": {
                    "katarak": $("#pvbackcharge").val()
                },
                "jaminan": {
                    "lakaLantas": ($("#pvreason_id") == 3 ? 1 : 0),
                    "noLP": $("#pvtemptrans").val(),
                    "penjamin": {
                        "tglKejadian": $("#pvvalid_rm_date").val(),
                        "keterangan": $("#pvdelete_sep").val(),
                        "suplesi": {
                            "suplesi": $("#pvispertarif").val(),
                            "noSepSuplesi": $("#pvno_skp").val(),
                            "lokasiLaka": {
                                "kdPropinsi": "",
                                "kdKabupaten": "",
                                "kdKecamatan": ""
                            }
                        }
                    }
                },
                "dpjpLayan": ($("#pvisrj").val() == 1 ? $("#pvkddpjp").val() : ""),
                "noTelp": sbio.mobile,
                "user": '<?= user()->username; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // $("#editSepBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>');
                $("#editSepBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    alert("Edit SEP Berhasil")
                    var result = data.response.sep
                    $("#pvno_skp").val(result.noSep)
                    $("#responput_vklaim").val(JSON.stringify(data))
                    $("#formaddpvbtn").click()
                } else {
                    alert(data.metaData.message)
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#editSepBtn").html('<i class="fa fa-edit"></i> <span>Edit SEP</span>');
            },
            complete: function() {
                $("#editSepBtn").html('<i class="fa fa-edit"></i> <span>Edit SEP</span>');
            }
        })
    }

    function deleteSep() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/deleteSep',
            type: "DELETE",
            data: JSON.stringify({
                'noSep': $("#pvno_skp").text(),
                "user": '<?= user()->username; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // $("#editSepBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>');
                $("#deleteSepBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    alert("Delete SEP Berhasil")
                    $("#pvno_skp").val('')
                    $("#skdpnosep").val('')
                    $("#formaddpvbtn").click()
                } else {
                    alert(data.metaData.message)
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $("#deleteSepBtn").html('<i class="fa fa-trash"></i> <span>Delete SEP</span>');
            },
            complete: function() {
                $("#deleteSepBtn").html('<i class="fa fa-trash"></i> <span>Delete SEP</span>');
            }
        })
    }

    function getSKDP() {
        $("#getSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

        var currentkey = $("#pvcurrentkey").val()
        var currentClinic = $("#pvclinic_id").val()
        var selectedVisit = ''
        skunjAll.forEach((element, key) => {
            if (key < currentkey && element.clinic_id == currentClinic)
                selectedVisit = element.visit_id
        })
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSKDP',
            type: "POST",
            data: JSON.stringify({
                'norm': $("#pvno_registration").val(),
                'kddpjp': $("#pvkddpjp").val(),
                'clinic_id': currentClinic,
                'visit_id': selectedVisit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert('Berhasil mengambil data SKDP')
                    $("#pvedit_sep").val(data.skdp)
                } else {
                    alert('tidak ada data SKDP')
                }
                $("#getSkdpBtn").html('<i class="fa fa-search"></i>')

            },
            error: function() {
                $("#getSkdpBtn").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function getSPRI() {
        $("#getSpriBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        alert("Get Nomor SKDP Berhasil")
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSPRI',
            type: "POST",
            data: JSON.stringify({
                'norm': id,
                'kddpjp': $("#pvkddpjp").val(),
                'clinic_id': $("#pvclinic_id").val(),
                'visit_id': $("#pvvisit_id").val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert('Berhasil mengambil data SPRI')
                    $("#pvspecimenno").val(data.spri)
                } else {
                    alert('tidak ada data SPRI')
                }
                $("#getSpriBtn").html('<i class="fa fa-search"></i>')
            },
            error: function() {
                $("#getSpriBtn").html('<i class="fa fa-search"></i>')
            }
        });
    }


    function getHistoryRajalPasien(id) {
        $("#loadingHistoryrajal").show()
        $("#loadingHistoryrajal").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/gethistoryrajaldatatable',
            type: "POST",
            data: JSON.stringify({
                'norm': id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableHistoryRajal.clear().draw()
                data.data.forEach((element, key) => {
                    tableHistoryRajal.row.add(element).draw()
                });
                $("#loadingHistoryrajal").html('')
                $("#loadingHistoryrajal").hide()
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    // function getHistoryRajalPasien(id) {
    //     $("#loadingHistoryrajal").show()
    //     $("#loadingHistoryrajal").html('<i class="spinner-border spinner-border-sm"></i>')
    //     // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/pendaftaran/gethistoryrajaldatatable',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'norm': id
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {
    //             tableHistoryRajal.clear().draw()
    //             data.data.forEach((element, key) => {
    //                 tableHistoryRajal.row.add(element).draw()
    //             });
    //             $("#loadingHistoryrajal").html('')
    //             $("#loadingHistoryrajal").hide()
    //         },
    //         error: function() {
    //             $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
    //         }
    //     });
    // }

    function getHistoryPv(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getHistoryPv',
            type: "POST",
            data: JSON.stringify({
                'norm': id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                skunjAll = data
                var now = new Date()
                var lastkunj = new Date(skunjAll[skunjAll.length - 1].visit_date)

                var daydiff = datediff(lastkunj, now)

                console.log(daydiff)

                if (daydiff != 0) {
                    skunjAll.push([])
                }

                viewKunjunganOnModal(0, skunjAll.length - 1)

            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function viewKunjunganOnModal(isnext = 0, key = null) {

        if (key == null) {
            key = (Number)($("#pvcurrentkey").val()) + isnext
        }
        if (key < 0) {
            key = 0
        }
        if (key > skunjAll.length - 1) {
            key = skunjAll.length - 1
        }
        var page = skunjAll.length - key
        $("#paginationRajalText").html(page + " dari " + skunjAll.length + " kunjungan")

        if (typeof skunjAll[key].visit_id !== 'undefined') {

            skunj = skunjAll[key]

            $("#pvcurrentkey").val(key)

            $("#pvtrans_id").val(skunj.trans_id)
            $("#pvticket_no").val(skunj.ticket_no)
            // <input name="visit_id" id="pvvisit_id" type="hidden" class="form-control" />
            $("#pvvisit_id").val(skunj.visit_id)
            //                 <input name="no_registration" id="pvno_registration" type="hidden" class="form-control" />
            $("#pvno_registration").val(skunj.no_registration);
            //                 <input name="diantar_oleh" id="pvdiantar_oleh" type="hidden" class="form-control" />
            $("#pvdiantar_oleh").val(skunj.diantar_oleh);
            //                 <input name="visitor_address" id="pvvisitor_address" type="hidden" class="form-control" />
            $("#pvvisitor_address").val(skunj.visitor_address);
            //                 <input name="org_unit_code" id="pvorg_unit_code" type="hidden" class="form-control" />
            $("#pvorg_unit_code").val(skunj.org_unit_code);
            //                 <input name="tgl_lahir" id="pvtgl_lahir" type="hidden" class="form-control" />
            $("#pvtgl_lahir").val(skunj.tgl_lahir);
            //                 <input name="gender" id="pvgender" type="hidden" class="form-control" />
            $("#pvgender").val(skunj.gender);
            //                 <input name="payor_id" id="pvpayor_id" type="hidden" class="form-control" />
            $("#pvpayor_id").val(skunj.payor_id);
            //                 <input name="clinic_id_from" id="pvclinic_id_from" type="hidden" class="form-control" />
            $("#pvclinic_id_from").val(skunj.clinic_id_from);
            //                 <input name="pasien_id" id="pvpasien_id" type="hidden" class="form-control" />
            $("#pasien_id").val(skunj.pasien_id);
            //                 <input name="karyawan" id="pvkaryawan" type="hidden" class="form-control" />
            $("#pvkaryawan").val(skunj.karyawan)
            //                 <input name="family_status_id" id="pvfamily_status_id" type="hidden" class="form-control" />
            $("#pvfamily_status_id").val(skunj.family_status_id)
            //                 <input name="account_id" id="pvaccount_id" type="hidden" class="form-control" />
            $("#pvaccount_id").val(skunj.account_id)
            //                 <input name="coverage_Id" id="pvcoverage_Id" type="hidden" class="form-control" />
            $("#pvcoverage_id").val(skunj.coverage_id)
            //                 <input name="ageday" id="pvageday" type="hidden" class="form-control" />
            $("#pvageday").val(skunj.ageday)
            //                 <input name="agemonth" id="pvagemonth" type="hidden" class="form-control" />
            $("#pvagemonth").val(skunj.agemonth)
            //                 <input name="ageyear" id="pvageyear" type="hidden" class="form-control" />
            $("#pvageyear").val(skunj.ageyear)
            //                 <input name="kode_agama" id="pvagama" type="hidden" class="form-control" />
            $("#pvagama").val(skunj.kode_agama)
            //                 <input name="aktif" id="pvaktif" type="hidden" class="form-control" />
            $("#pvaktif").val(skunj.aktif)
            //                 <input name="isrj" id="pvisrj" type="hidden" class="form-control" />
            $("#pvisrj").val(skunj.isrj);

            $("#pvclinic_id").val(skunj.clinic_id)
            $("#pvemployee_id").html("");
            var clinicSelected = skunj.clinic_id
            dokterdpjp.forEach((value, key) => {
                if (value[0] == clinicSelected) {
                    $("#pvemployee_id").append(new Option(value[2], value[1]))
                }
            })
            $("#pvemployee_id").val(skunj.employee_id)
            $("#pvkddpjp").html("")
            $("#pvkddpjp").append(new Option(skunj.kddpjp, skunj.kddpjp))
            $("#pvkddpjp").val(skunj.kddpjp)
            $("#pvclass_id").val(skunj.class_id);
            $("#pvclass_id_plafond").val(skunj.class_id_plafond)
            $("#pvstatus_pasien_id").val(skunj.status_pasien_id)
            $("#pvvisit_date").val((String)(skunj.visit_date).slice(0, 16))
            $("#pvbooked_date").val((String)(skunj.booked_date).slice(0, 16))
            $("#pvkdpoli_eks").val(skunj.kdpoli_eks)
            $("#pvisnew").val(skunj.isnew)
            $("#pvcob").val(skunj.cob)
            $("#pvdescription").val(skunj.description) //catatan
            $("#pvbackcharge").val(skunj.backcharge) //katarak
            $("#pvway_id").val(skunj.way_id)
            $("#pvreason_id").val(skunj.reason_id)
            $("#pvisattended").val((Number)(skunj.isattended))
            $("#pvasalrujukan").val(skunj.asalrujukan)
            $("#pvnorujukan").val(skunj.norujukan)
            $("#pvkdpoli").val(skunj.kdpoli)
            $("#pvtanggal_rujukan").val((String)(skunj.tanggal_rujukan).slice(0, 10))
            $("#pvppkrujukan").val(skunj.ppkrujukan)
            $("#pvdiag_awal").html("")
            $("#pvdiag_awal").append(new Option(skunj.conclusion, skunj.diag_awal))
            $("#pvconclusion").val(skunj.conclusion)
            $("#pvdiagnosa_id").val(skunj.diagnosa_id)
            $("#pvkdpoli_from").val(skunj.kdpoli_from)
            $("#pvtujuankunj").val(skunj.tujuankunj)
            $("#pvkdpenunjang").val(skunj.kdpenunjang)
            $("#pvflagprocedure").val(skunj.flagprocedure)
            $("#pvassesmentpel").val(skunj.assesmentpel)
            $("#pvedit_sep").val(skunj.edit_sep)
            $("#pvspecimenno").val(skunj.specimenno)
            $("#pvno_skp").val(skunj.no_skp)
            $("#pvno_skpinap").val(skunj.no_skpinap)
            if (skunj.no_skpinap != null && skunj.no_skpinap != '') {
                $("#skdpnosep").val(skunj.no_skpinap)
            } else {
                $("#skdpnosep").val(skunj.no_skp)
            }
            $("#pvvalid_rm_date").val(skunj.valid_rm_date) //tanggal kejadian laka
            $("#pvpenjamin").val(skunj.penjamin) //penjamin laka
            $("#pvlokasilaka").val(skunj.lokasilaka) //lokasi laka
            $("#pvispertarif").val(skunj.ispertarif) //suplesi
            $("#pvtemptrans").val(skunj.temptrans) //No LP
            $("#pvdelete_sep").val(skunj.delete_sep) //keterangan laka

            var start = new Date(skunj.visit_date)
            var end = new Date()

            var daydiff = datediff(start, end)

            disableFormPv()
            $("#formaddpvbtn").hide()
            if (daydiff < 4) {
                $("#formeditpvbtn").show()
                $("#formdelpvbtn").show()
            } else {
                $("#formeditpvbtn").hide()
                $("#formdelpvbtn").hide()
            }

            // $("#headingKunjunganBtn").click()


            // $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
        } else {
            $("#pvcurrentkey").val(key)


            $("#pvtrans_id").val(null)
            $("#pvticket_no").val(null)
            // <input name="visit_id" id="pvvisit_id" type="hidden" class="form-control" />
            $("#pvvisit_id").val(null)
            //                 <input name="no_registration" id="pvno_registration" type="hidden" class="form-control" />
            $("#pvno_registration").val(sbio.no_registration);
            //                 <input name="diantar_oleh" id="pvdiantar_oleh" type="hidden" class="form-control" />
            $("#pvdiantar_oleh").val(sbio.name_of_pasien);
            //                 <input name="visitor_address" id="pvvisitor_address" type="hidden" class="form-control" />
            $("#pvvisitor_address").val(sbio.contact_address);
            //                 <input name="org_unit_code" id="pvorg_unit_code" type="hidden" class="form-control" />
            $("#pvorg_unit_code").val(sbio.org_unit_code);
            //                 <input name="tgl_lahir" id="pvtgl_lahir" type="hidden" class="form-control" />
            $("#pvtgl_lahir").val(sbio.date_of_birth);
            //                 <input name="gender" id="pvgender" type="hidden" class="form-control" />
            $("#pvgender").val(sbio.gender);
            //                 <input name="payor_id" id="pvpayor_id" type="hidden" class="form-control" />
            $("#pvpayor_id").val(sbio.payor_id);
            //                 <input name="clinic_id_from" id="pvclinic_id_from" type="hidden" class="form-control" />
            $("#pvclinic_id_from").val("P000");
            //                 <input name="pasien_id" id="pvpasien_id" type="hidden" class="form-control" />
            $("#pasien_id").val(sbio.kk_no);
            //                 <input name="karyawan" id="pvkaryawan" type="hidden" class="form-control" />
            $("#pvkaryawan").val(null)
            //                 <input name="family_status_id" id="pvfamily_status_id" type="hidden" class="form-control" />
            $("#pvfamily_status_id").val(sbio.family_status_id)
            //                 <input name="account_id" id="pvaccount_id" type="hidden" class="form-control" />
            $("#pvaccount_id").val(sbio.account_id)
            //                 <input name="coverage_Id" id="pvcoverage_Id" type="hidden" class="form-control" />
            $("#pvcoverage_id").val(sbio.coverage_id)
            //                 <input name="ageday" id="pvageday" type="hidden" class="form-control" />

            var age = getAge(sbio.date_of_birth);
            $("#pvageyear").val(age.years)
            $("#pvagemonth").val(age.month)
            $("#pvageday").val(age.days)
            //                 <input name="kode_agama" id="pvagama" type="hidden" class="form-control" />
            $("#pvagama").val(sbio.kode_agama)
            //                 <input name="aktif" id="pvaktif" type="hidden" class="form-control" />
            $("#pvaktif").val(sbio.aktif)
            //                 <input name="isrj" id="pvisrj" type="hidden" class="form-control" />
            $("#pvisrj").val(1);

            $("#pvclinic_id").val(null)
            $("#pvemployee_id").html(null)
            var clinicSelected = skunj.clinic_id
            dokterdpjp.forEach((value, key) => {
                if (value[0] == clinicSelected) {
                    $("#pvemployee_id").append(new Option(value[2], value[1]))
                }
            })
            $("#pvemployee_id").val(null)
            $("#pvkddpjp").html("")
            $("#pvclass_id").val(sbio.class_id);
            $("#pvclass_id_plafond").val(sbio.class_id);
            $("#pvstatus_pasien_id").val(sbio.status_pasien_id);
            $("#pvvisit_date").val((get_date()).slice(0, 16));
            $("#pvbooked_date").val((get_date()).slice(0, 16));
            $("#pvkdpoli_eks").val(0)
            if (skunjAll.length < 1)
                $("#pvisnew").val(0)
            else
                $("#pvisnew").val(1)

            $("#pvcob").val(0)
            $("#pvdescription").val("") //catatan
            if (sbio.backcharge == null) {
                $("#pvbackcharge").val(0) //katarak
            } else {
                $("#pvbackcharge").val(sbio.backcharge) //katarak
            }
            $("#pvway_id").val(17)
            $("#pvreason_id").val(0)
            $("#pvisattended").val(0)
            $("#pvasalrujukan").val(null)
            $("#pvnorujukan").val(null)
            $("#pvkdpoli").val(null)
            $("#pvtanggal_rujukan").val(null)
            $("#pvppkrujukan").val(null)
            $("#pvdiag_awal").html("")
            $("#pvconclusion").val(null)
            $("#pvdiagnosa_id").val(null)
            $("#pvkdpoli_from").val(null)
            $("#pvtujuankunj").val(0)
            $("#pvkdpenunjang").val(99)
            $("#pvflagprocedure").val(99)
            $("#pvassesmentpel").val(99)
            $("#pvedit_sep").val(null)
            $("#pvspecimenno").val(null)
            $("#pvno_skp").val(null)
            $("#pvno_skpinap").val(null)
            $("#skdpnosep").val(null)
            $("#pvvalid_rm_date").val(null) //tanggal kejadian laka
            $("#pvpenjamin").val(null) //penjamin laka
            $("#pvlokasilaka").val(null) //lokasi laka
            $("#pvispertarif").val(null) //suplesi
            $("#pvtemptrans").val(null) //No LP
            $("#pvdelete_sep").val(null) //keterangan laka

            enableFormPV()
            $("#formaddpvbtn").show()
            $("#formeditpvbtn").hide()
            $("#formdelpvbtn").hide()
        }
        if (!$("#collapseKunjungan").hasClass("show")) {
            $("#headingKunjunganBtn").click()
        }
    }

    function enableFormPV() {
        $("#pvclinic_id").prop("disabled", false)
        $("#pvemployee_id").prop("disabled", false)
        $("#pvkddpjp").prop("disabled", false)
        $("#pvkddpjp").prop("disabled", false)

        $("#pvkddpjp").prop("disabled", false)

        $("#pvclass_id").prop("disabled", false)

        $("#pvclass_id_plafond").prop("disabled", false)

        $("#pvstatus_pasien_id").prop("disabled", false)

        $("#pvvisit_date").prop("disabled", false)

        $("#pvbooked_date").prop("disabled", false)

        $("#pvkdpoli_eks").prop("disabled", false)

        $("#pvisnew").prop("disabled", false)

        $("#pvcob").prop("disabled", false)

        $("#pvdescription").prop("disabled", false)

        $("#pvbackcharge").prop("disabled", false)

        $("#pvway_id").prop("disabled", false)

        $("#pvreason_id").prop("disabled", false)

        $("#pvisattended").prop("disabled", false)

        $("#pvasalrujukan").prop("disabled", false)

        $("#pvnorujukan").prop("disabled", false)

        $("#pvkdpoli").prop("disabled", false)

        $("#pvtanggal_rujukan").prop("disabled", false)

        $("#pvppkrujukan").prop("disabled", false)

        $("#pvdiag_awal").prop("disabled", false)

        $("#pvconclusion").prop("disabled", false)

        $("#pvdiagnosa_id").prop("disabled", false)

        $("#pvkdpoli_from").prop("disabled", false)

        $("#pvtujuankunj").prop("disabled", false)

        $("#pvkdpenunjang").prop("disabled", false)

        $("#pvflagprocedure").prop("disabled", false)

        $("#pvassesmentpel").prop("disabled", false)

        $("#pvedit_sep").prop("disabled", false)

        $("#pvspecimenno").prop("disabled", false)

        $("#pvno_skp").prop("disabled", false)

        $("#pvno_skpinap").prop("disabled", false)

        $("#pvvalid_rm_date").prop("disabled", false)

        $("#pvpenjamin").prop("disabled", false)

        $("#pvlokasilaka").prop("disabled", false)

        $("#pvispertarif").prop("disabled", false)

        $("#pvtemptrans").prop("disabled", false)

        $("#pvdelete_sep").prop("disabled", false)


        $("#getRujukanBtn").prop("disabled", false)
        $("#createSepBtn").prop("disabled", false)
        $("#editSepBtn").prop("disabled", false)
        $("#deleteSepBtn").prop("disabled", false)
        $("#saveSkdpBtn").prop("disabled", false)
        $("#checkSkdpBtn").prop("disabled", false)
        $("#deleteSkdpBtn").prop("disabled", false)



        $("#formaddpvbtn").show()
        $("#formeditpvbtn").hide()
        // $("#formdelpvbtn").hide()
    }

    function disableFormPv() {
        $("#pvclinic_id").prop("disabled", true)
        $("#pvemployee_id").prop("disabled", true)
        $("#pvkddpjp").prop("disabled", true)
        $("#pvkddpjp").prop("disabled", true)

        $("#pvkddpjp").prop("disabled", true)

        $("#pvclass_id").prop("disabled", true)

        $("#pvclass_id_plafond").prop("disabled", true)

        $("#pvstatus_pasien_id").prop("disabled", true)

        $("#pvvisit_date").prop("disabled", true)

        $("#pvbooked_date").prop("disabled", true)

        $("#pvkdpoli_eks").prop("disabled", true)

        $("#pvisnew").prop("disabled", true)

        $("#pvcob").prop("disabled", true)

        $("#pvdescription").prop("disabled", true)

        $("#pvbackcharge").prop("disabled", true)

        $("#pvway_id").prop("disabled", true)

        $("#pvreason_id").prop("disabled", true)

        $("#pvisattended").prop("disabled", true)

        $("#pvasalrujukan").prop("disabled", true)

        $("#pvnorujukan").prop("disabled", true)

        $("#pvkdpoli").prop("disabled", true)

        $("#pvtanggal_rujukan").prop("disabled", true)

        $("#pvppkrujukan").prop("disabled", true)

        $("#pvdiag_awal").prop("disabled", true)

        $("#pvconclusion").prop("disabled", true)

        $("#pvdiagnosa_id").prop("disabled", true)

        $("#pvkdpoli_from").prop("disabled", true)

        $("#pvtujuankunj").prop("disabled", true)

        $("#pvkdpenunjang").prop("disabled", true)

        $("#pvflagprocedure").prop("disabled", true)

        $("#pvassesmentpel").prop("disabled", true)

        $("#pvedit_sep").prop("disabled", true)

        $("#pvspecimenno").prop("disabled", true)

        $("#pvno_skp").prop("disabled", true)

        $("#pvno_skpinap").prop("disabled", true)

        $("#pvvalid_rm_date").prop("disabled", true)

        $("#pvpenjamin").prop("disabled", true)

        $("#pvlokasilaka").prop("disabled", true)

        $("#pvispertarif").prop("disabled", true)

        $("#pvtemptrans").prop("disabled", true)

        $("#pvdelete_sep").prop("disabled", true)

        $("#getRujukanBtn").prop("disabled", true)
        $("#createSepBtn").prop("disabled", true)
        $("#editSepBtn").prop("disabled", true)
        $("#deleteSepBtn").prop("disabled", true)
        $("#saveSkdpBtn").prop("disabled", true)
        $("#checkSkdpBtn").prop("disabled", true)
        $("#deleteSkdpBtn").prop("disabled", true)

        $("#formaddpvbtn").hide()
        $("#formeditpvbtn").show()
    }

    function saveSkdp() {
        var skdpnosep = $("#skdpnosep").val()
        var skdpkddpjp = $("#skdpkddpjp").val()
        var skdpkdpoli = $("#skdpkdpoli").val()
        var skdptglkontrol = $("#skdptglkontrol").val()
        var skdpnosurat = $("#skdpnosurat").val()

        if (skdpnosep == '') {
            alert('No SEP harus diisi!')
        } else if (skdpkddpjp == '' || skdpkddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (skdpkdpoli == '' | skdpkdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (skdptglkontrol == '' || skdptglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/saveSkdp',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noSEP": skdpnosep,
                        "kodeDokter": skdpkddpjp,
                        "poliKontrol": skdpkdpoli,
                        "tglRencanaKontrol": skdptglkontrol,
                        "user": '<?= user()->username; ?>'
                    },
                    "visit_id": $("#pvvisit_id").val(),
                    "noSuratKontrol": skdpnosurat,
                    'no_registration': $("#pvno_registration").val()
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting SKDP!")
                        $("#skdpnosurat").val(data.response.noSuratKontrol)
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSkdpBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    function deleteSkdp() {
        var skdpnosurat = $("#skdpnosurat").val()
        if (skdpnosurat == '' || skdpnosurat == null) {
            alert('Kolom Nomor SKDP tidak boleh kosong saat menghapus')
        } else {
            $("#deleteSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            skdptglkontrol == (String)(skdptglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/deleteSkdp',
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

    function checkSkdp() {
        $("#checkSkdpBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var skdpnosurat = $("#skdpnosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSkdp',
            type: "POST",
            data: JSON.stringify({
                "visit": $("#pvvisit_id").val()
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