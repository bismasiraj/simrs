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
    $("#formaddpv").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
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
                    successMsg(data.message);
                    url = '<?= base_url(); ?>' + '/admin/patient/profile/' + data.visit_id
                    $("#addKunjunganModal").modal("hide")
                    $("#patientDetails").hide();
                    window.open(url)

                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));

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
                        $("#pvpasien_id").html(data.pasien_id);
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
                        $("#pvbooked_date").val(get_date());
                        $("#pvvisit_date").val(get_date());
                        $("#pvstatus_pasien_id").val(sbio.status_pasien_id);
                        $("#pvclinic_id_from").val('P000');
                        $("#pvtanggal_rujukan").val(get_date());
                        $("#pvpasien_id").val(sbio.status_pasien_id);
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
            Object.keys(dpjp).forEach(key => {
                if (key == value[1]) {
                    console.log(key, dpjp[key]);
                    $("#pvkddpjp").append(new Option(dpjp[key], key));
                }
            });
        })
    });
    $("#pvemployee_id").on("click", function() {
        $("#pvkddpjp").html("");
        var dokterSelected = $("#pvemployee_id").val();
        Object.keys(dpjp).forEach(key => {
            if (key == dokterSelected) {
                console.log(key, dpjp[key]);
                $("#pvkddpjp").append(new Option(dpjp[key], key));
            }
        });
    });

    function getRujukan() {
        alert("Get Rujukan Berhasil")
        $("#pvasalrujukan").val(1)
        $("#pvnorujukan").val('0097R0090520B000006')
        $("#pvkdpoli").val('INT')
        $("#pvtanggal_rujukan").val('2020-05-19 00:00:00.000')
        $("#pvppkrujukan").val('0097B011')
    }

    function insertSep() {
        var clicked_submit_btn = $("#addSep")

        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/insertSep',
            type: "POST",
            data: JSON.stringify({
                'noKartu': $("#pvkk_no").text(),
                "tglSep": "2021-07-30",
                "ppkPelayanan": $("#pvorg_unit_code").val(),
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
                "catatan": "",
                "diagAwal": $("#pvdiag_awal").val(),
                "poli": {
                    "tujuan": $("#pvclinic_id").val(),
                    "eksekutif": $("#pvkdpoli_eks").val()
                },
                "cob": {
                    "cob": "0"
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
                "noTelp": "081111111101",
                "user": "Coba Ws"
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    $("#arnorujukan").val("");
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        })
        alert("insert SEP Berhasil")
        $("#pvno_skp").val('0701R0010520V001645')
    }

    function deleteSep() {
        alert("Delete SEP Berhasil")
        $("#pvno_skp").val('')
    }

    function insertSKDP() {
        alert("Get Nomor SKDP Berhasil")
        $("#pvedit_sep").val("0701R0010422K002046")
    }

    function insertSPRI() {
        alert("Get Nomor SKDP Berhasil")
        $("#pvspecimenno").val("0701R0010422K002045")
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
</script>