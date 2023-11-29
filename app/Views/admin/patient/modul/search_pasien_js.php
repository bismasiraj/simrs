<script type="text/javascript">
    var sbioArray;
    var sbio = new Array();
    var skunj = new Array();
    var tablePasien = $("#datapasien").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    var dataPasien = Array();
    var validatorBiodata = $('#formaddpa').validate({ // initialize the plugin
        rules: {
            nama: {
                required: true
            },
            pasien_id: {
                required: true,
                minlength: 16,
                maxlength: 16
            }
        }
    });
    $(document).ready(function() {

        var coverage = status = jenis = kelas = kalurahan = kecamatan = kota = prov = statusPasien = payor = education = marital = agama = job = blood = gender = family = new Array();


        gender = [
            <?php foreach ($gender as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $gender[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        <?php foreach ($coverage as $key => $value) { ?>
            coverage[<?= $coverage[$key]['coverage_id']; ?>] = '<?= $coverage[$key]['coveragetype']; ?>';
        <?php } ?>
        <?php foreach ($status as $key => $value) { ?>
            status[<?= $status[$key]['status_peserta_kode']; ?>] = '<?= $status[$key]['status_peserta']; ?>';
        <?php } ?>
        <?php foreach ($jenis as $key => $value) { ?>
            jenis[<?= $jenis[$key]['kdjnspeserta']; ?>] = '<?= $jenis[$key]['nmjnspeserta']; ?>';
        <?php } ?>
        kelas = [
            <?php foreach ($kelas as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kelas[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        kalurahan = [
            <?php foreach ($kalurahan as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kalurahan[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        kecamatan = [
            <?php foreach ($kecamatan as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kecamatan[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        kota = [
            <?php foreach ($kota as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kota[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        prov = [
            <?php foreach ($prov as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $prov[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];

        statusPasien = [
            <?php foreach ($statusPasien as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $statusPasien[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];

        payor = [
            <?php foreach ($payor as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $payor[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];

        agama = [
            <?php foreach ($agama as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $agama[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        marital = [
            <?php foreach ($marital as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $marital[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        blood = [
            <?php foreach ($blood as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $blood[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        job = [
            <?php foreach ($job as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $job[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];

        education = [
            <?php foreach ($education as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $education[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        family = [
            <?php foreach ($family as $key => $value) { ?>[
                    <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $family[$key][$key1]); ?>',
                    <?php } ?>],
            <?php } ?>
        ];
        $("#formbiodata").on('submit', (function(e) {

            e.preventDefault();
            $("#formbiodatabtn").html('<i class="spinner-border spinner-border-sm"></i>')
            // spinner-border spinner-border-sm
            $.ajax({
                url: '<?php echo base_url(); ?>admin/admin/getpatientdatatable',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    sbioArray = data.biodata
                    console.log(sbioArray)
                    tablePasien.clear().draw()
                    var stringcolumn = '';
                    data.data.forEach((element, key) => {
                        // stringcolumn += '<tr class="table tablecustom-light">';
                        // element.forEach((element1, key1) => {
                        //     stringcolumn += "<td>" + element1 + "</td>";
                        // });
                        // stringcolumn += '</tr>'
                        tablePasien.row.add(element).draw()

                    });
                    // $(".ajaxlist").html(stringcolumn);
                    $("#formbiodatabtn").button('reset');
                    // tablePasien.draw()
                    // dataPasien = data.data
                    // $('#datatable').DataTable().ajax.reload();
                    $("#formbiodatabtn").html('<i class="fa fa-search"></i>')


                },
                error: function() {
                    $("#formbiodatabtn").html('<i class="fa fa-search"></i>')
                }
            });
        }))
    });
</script>

<!-- //========datatable start===== -->
<script type="text/javascript">
    // function getpatientdatatable() {
    //     alert('masuk')

    // }
</script>
<!-- //========datatable end===== -->

<script type="text/javascript">
    function holdModal(modalId) {
        $('#' + modalId).modal("show");
    }

    function getStrKunjungan(id) { //untuk view resume pasien

        $.ajax({
            url: baseurl + 'admin/patient/getpatientDetails',
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                sbio = data
                var link = '';
                <?php if (user()->checkPermission('biodatapasien', 'd')) { ?>
                    if (data.ismeninggal == 0) {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                    } else {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                    }
                <?php } ?>


                if (data.gender == '1') {
                    $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" alt="User profile picture">')
                } else {
                    $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_female.png' ?>" alt="User profile picture">')
                }

                $("patientid").val(data.no_registration);
                $("#patient_name").html(data.name_of_pasien + " (" + data.no_registration + ")");
                $("#kk_no").html(data.KK_NO);
                coverage.forEach((element, index) => {
                    if (index == data.coverage_id) {
                        $("#coverages").html(element);
                    }
                });
                $("#pasien_id").html(data.pasien_id);
                kelas.forEach(value => {
                    if (value[0] == data.class_id) {
                        $("#class_id").html(value[1]);
                    }
                });
                $("#placebirth").html(data.place_of_birth);
                $("#datebirth").html(data.date_of_birth.substring(0, 10));
                $("#age").html(data.patient_age);
                $("#description").html(data.description);
                $("#address").html(data.contact_address);
                $("#rtrw").html(data.rt + " / " + data.rw);
                kalurahan.forEach(kalvalue => {
                    if (sbio.kal_id == kalvalue[0]) {
                        $("#kalurahan").html(kalvalue[1]);
                        kecamatan.forEach(kecvalue => {
                            if (kecvalue[0] == kalvalue[2]) {
                                $("#kecamatan").html(kecvalue[1]);
                                kota.forEach(kotavalue => {
                                    if (kecvalue[2] == kotavalue[1]) {
                                        $("#kota").html(kotavalue[2]);
                                        prov.forEach(provvalue => {
                                            if (provvalue[0] == kotavalue[0]) {
                                                $("#prov").html(provvalue[2]);
                                            }
                                        })
                                    }

                                });
                            }
                        });
                    }
                })

                $("#phone").html(data.phone_number + " / " + data.mobile);
                statusPasien.forEach(value => {
                    if (value[0] == data.status_pasien_id) {
                        $("#status").html(value[1]);
                    }
                });
                payor.forEach(payorvalue => {
                    if (payorvalue[1] == data.payor_id) {
                        $("#payor").html(payorvalue[3]);
                    }
                });

                $("#ayah").html(data.father);
                $("#ibu").html(data.mother);
                $("#sutri").html(data.spouse);
                education.forEach(value => {
                    if (value[0] == data.education_type_code) {
                        $("#edukasi").html(value[1]);
                    }
                });
                job.forEach(jobvalue => {
                    if (jobvalue[0] == data.job_id) {
                        $("#pekerjaan").html(jobvalue[1]);
                    }
                });
                blood.forEach(bloodvalue => {
                    if (bloodvalue[1] == data.blood_type_id) {
                        $("#goldar").html(bloodvalue[0]);
                    }
                });
                agama.forEach(agamavalue => {
                    if (agamavalue[0] == data.kode_agama) {
                        $("#agama").html(agamavalue[1]);
                    }
                });
                marital.forEach(maritalvalue => {
                    if (maritalvalue[0] == data.maritalstatusid) {
                        $("#perkawinan").html(maritalvalue[1]);
                    }
                });
                gender.forEach(gendervalue => {
                    if (gendervalue[0] == data.gender) {
                        $("#gender").html(gendervalue[1]);
                    }
                });
                family.forEach(value => {
                    if (value[0] == data.family_status_id) {
                        $("#family").html(value[1]);
                    }
                });
                $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fas fa-pencil-alt'></i></a>" + link + "");

            },
        });

    }

    // function getpatientData(id) {
    //     $('#modal_head').html("<?php echo lang('Word.patient_details'); ?>");
    //     $.ajax({
    //         url: baseurl + 'admin/patient/getpatientDetails',
    //         type: "POST",
    //         data: {
    //             id: id
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             sbio = data
    //             var link = '';
    //             <?php if (user()->checkPermission('biodatapasien', 'd')) { ?>
    //                 if (data.ismeninggal == 0) {
    //                     var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
    //                 } else {
    //                     var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
    //                 }
    //             <?php } ?>


    //             if (data.gender == '1') {
    //                 $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" alt="User profile picture">')
    //             } else {
    //                 $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_female.png' ?>" alt="User profile picture">')
    //             }

    //             $("patientid").val(data.no_registration);
    //             $("#patient_name").html(data.name_of_pasien + " (" + data.no_registration + ")");
    //             $("#kk_no").html(data.KK_NO);
    //             coverage.forEach((element, index) => {
    //                 if (index == data.coverage_id) {
    //                     $("#coverages").html(element);
    //                 }
    //             });
    //             $("#pasien_id").html(data.pasien_id);
    //             kelas.forEach(value => {
    //                 if (value[0] == data.class_id) {
    //                     $("#class_id").html(value[1]);
    //                 }
    //             });
    //             $("#placebirth").html(data.place_of_birth);
    //             $("#datebirth").html(data.date_of_birth.substring(0, 10));
    //             $("#age").html(data.patient_age);
    //             $("#description").html(data.description);
    //             $("#address").html(data.contact_address);
    //             $("#rtrw").html(data.rt + " / " + data.rw);
    //             kalurahan.forEach(kalvalue => {
    //                 if (sbio.kal_id == kalvalue[0]) {
    //                     $("#kalurahan").html(kalvalue[1]);
    //                     kecamatan.forEach(kecvalue => {
    //                         if (kecvalue[0] == kalvalue[2]) {
    //                             $("#kecamatan").html(kecvalue[1]);
    //                             kota.forEach(kotavalue => {
    //                                 if (kecvalue[2] == kotavalue[1]) {
    //                                     $("#kota").html(kotavalue[2]);
    //                                     prov.forEach(provvalue => {
    //                                         if (provvalue[0] == kotavalue[0]) {
    //                                             $("#prov").html(provvalue[2]);
    //                                         }
    //                                     })
    //                                 }

    //                             });
    //                         }
    //                     });
    //                 }
    //             })

    //             $("#phone").html(data.phone_number + " / " + data.mobile);
    //             statusPasien.forEach(value => {
    //                 if (value[0] == data.status_pasien_id) {
    //                     $("#status").html(value[1]);
    //                 }
    //             });
    //             payor.forEach(payorvalue => {
    //                 if (payorvalue[1] == data.payor_id) {
    //                     $("#payor").html(payorvalue[3]);
    //                 }
    //             });

    //             $("#ayah").html(data.father);
    //             $("#ibu").html(data.mother);
    //             $("#sutri").html(data.spouse);
    //             education.forEach(value => {
    //                 if (value[0] == data.education_type_code) {
    //                     $("#edukasi").html(value[1]);
    //                 }
    //             });
    //             job.forEach(jobvalue => {
    //                 if (jobvalue[0] == data.job_id) {
    //                     $("#pekerjaan").html(jobvalue[1]);
    //                 }
    //             });
    //             blood.forEach(bloodvalue => {
    //                 if (bloodvalue[1] == data.blood_type_id) {
    //                     $("#goldar").html(bloodvalue[0]);
    //                 }
    //             });
    //             agama.forEach(agamavalue => {
    //                 if (agamavalue[0] == data.kode_agama) {
    //                     $("#agama").html(agamavalue[1]);
    //                 }
    //             });
    //             marital.forEach(maritalvalue => {
    //                 if (maritalvalue[0] == data.maritalstatusid) {
    //                     $("#perkawinan").html(maritalvalue[1]);
    //                 }
    //             });
    //             gender.forEach(gendervalue => {
    //                 if (gendervalue[0] == data.gender) {
    //                     $("#gender").html(gendervalue[1]);
    //                 }
    //             });
    //             family.forEach(value => {
    //                 if (value[0] == data.family_status_id) {
    //                     $("#family").html(value[1]);
    //                 }
    //             });
    //             $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fas fa-pencil-alt'></i></a>" + link + "");

    //             holdModal('rincianPasienModel');
    //             patientvisit(data.no_registration);
    //         },
    //     });

    // }

    function editBiodataPasien(id = null) {
        if (id != null) {
            sbio = sbioArray[id]
            editBiodata()
        } else {
            sbio = Array()
            clearBiodata()
        }
        holdModal('pasienModal');
    }

    function addVisitPatient(id) {
        get_PatientDetailspv(id)
        holdModal("addKunjunganModal")
    }

    function patientvisit(id) {
        $.ajax({
            url: baseurl + 'admin/patient/patientvisit',
            type: "POST",
            data: {
                'id': id
            },
            dataType: 'json',
            success: function(data) {
                $('#visit_report_id').html(data);
            }
        });
    }

    function editBiodata() {
        $("#ano_registration").val(sbio.no_registration);
        $("#anama").val(sbio.name_of_pasien);
        $("#apasien_id").val(sbio.pasien_id);
        $("#aclass_id").val(sbio.class_id);
        $("#aplacebirth").val(sbio.place_of_birth);
        $("#adatebirth").val(sbio.date_of_birth.substring(0, 10));
        $("#adescription").val(sbio.description);
        $("#aaddress").val(sbio.contact_address);
        $("#art").val(sbio.rt);
        $("#arw").val(sbio.rw);
        $("#aayah").val(sbio.father)
        $("#aibu").val(sbio.mother)
        $("#asutri").val(sbio.spouse)
        $("#aphone").val(sbio.phone_number);
        $("#amobile").val(sbio.mobile);
        $("#astatus").val(sbio.status_pasien_id);
        $("#apayor").val(sbio.payor_id);
        $("#aedukasi").val(sbio.education_type_code);
        $("#apekerjaan").val(sbio.job_id);
        $("#agoldar").val(sbio.blood_type_id);
        $("#aagama").val(sbio.kode_agama);
        $("#agender").val(sbio.gender);
        $("#apisa").val(sbio.coverage_id);
        $("#afamily").val(sbio.family_status_id);
        $("#akk_no").val(sbio.kk_no);
        // $("#etmt").val(sbio.tmt.substring(0, 10));
        // $("#etat").val(sbio.tat.substring(0, 10));
        $("#aperkawinan").val(sbio.maritalstatusid);

        var kalselect = '';
        var kotaselect = '';
        var provselect = '';

        $("#akalurahan").html()
        $("#akecamatan").html()
        $("#akota").html()

        kalurahan.forEach(kalvalue => {
            if (sbio.kal_id == kalvalue[0]) {
                $("#akalurahan").append(new Option(kalvalue[1], sbio.kal_id))
                $('#akalurahan').val(sbio.kal_id)
                $('#akalurahan').prop("disabled", false)
                // $('select[id="ekalurahan"] option[value="' + kalvalue[0] + '"]').attr("selected", "selected");
                kecamatan.forEach(kecvalue => {
                    if (kecvalue[0] == kalvalue[2]) {
                        $("#akecamatan").append(new Option(kecvalue[1], kecvalue[0]))
                        $('#akecamatan').val(kecvalue[0])
                        $('#akecamatan').prop("disabled", false)
                        kota.forEach(kotavalue => {
                            if (kecvalue[2] == kotavalue[1]) {
                                $("#akota").append(new Option(kotavalue[2], kotavalue[1]));
                                $('#akota').val(kotavalue[1])
                                $('#akota').prop("disabled", false)
                                prov.forEach(provvalue => {
                                    if (provvalue[0] == kotavalue[0]) {
                                        $('#aprov').val(kotavalue[0])
                                    }
                                })
                            }

                        });
                    }
                });
            }
        })

        $("#rincianPasienModel").modal('hide');
        // $("#imgprofilediv").html('<input class="filestyle form-control-file" type="file" name="file" id="axampleInputFile" size="20" data-height="26" data-default-file="data:image/*;base64,' + sbio.ttd + '">');
        if (typeof sbio.ttd !== 'undefined' && sbio.ttd != null)
            $("#imgprofile").attr('src', 'data:image/*;base64,' + sbio.ttd)
        else
            $("#imgprofile").attr('src', "<?php echo base_url() ?>uploads / patient_images / no_image.png");

        validatorBiodata.resetForm()
    }

    function clearBiodata() {
        $("#ano_registration").val("");
        $("#anama").val("");
        $("#apasien_id").val("");
        $("#aclass_id").val("");
        $("#aplacebirth").val("");
        $("#adatebirth").val("");
        $("#adescription").val("");
        $("#aaddress").val("");
        $("#art").val("");
        $("#arw").val("");
        $("#aayah").val("")
        $("#aibu").val("")
        $("#asutri").val("")
        $("#aphone").val("");
        $("#amobile").val("");
        $("#astatus").val("");
        $("#apayor").val("");
        $("#aedukasi").val("");
        $("#apekerjaan").val("");
        $("#agoldar").val("");
        $("#aagama").val("");
        $("#agender").val("");
        $("#apisa").val("");
        $("#afamily").val("");
        $("#akk_no").val("");
        // $("#etmt").val(sbio.tmt.substring(0, 10));
        // $("#etat").val(sbio.tat.substring(0, 10));
        $("#aperkawinan").val("");

        var kalselect = '';
        var kotaselect = '';
        var provselect = '';

        $("#akalurahan").val(kalselect)
        $("#akecamatan").val(kotaselect)
        $("#akota").val(provselect)

        validatorBiodata.resetForm()
    }

    // $(document).ready(function(e) {
    //     $('#eprov').on("click", function() {
    //         $("#ekota").html("")
    //         $("#ekecamatan").html("")
    //         $("#ekecamatan").prop("disabled", true)
    //         $("#ekalurahan").html("")
    //         $("#ekalurahan").prop("disabled", true)
    //         var selprov = $('#eprov').val()
    //         kota.forEach(kotavalue => {
    //             if (kotavalue[0] == selprov) {
    //                 $("#ekota").append(new Option(kotavalue[2], kotavalue[1]));
    //                 $("#ekota").prop("disabled", false)
    //             }

    //         });
    //     })
    //     $('#ekota').on("click", function() {
    //         $("#ekecamatan").html("")
    //         $("#ekecamatan").prop("disabled", true)
    //         $("#ekalurahan").html("")
    //         $("#ekalurahan").prop("disabled", true)
    //         var selkota = $('#ekota').val()
    //         kecamatan.forEach(kecvalue => {
    //             if (kecvalue[2] == selkota) {
    //                 $("#ekecamatan").append(new Option(kecvalue[1], kecvalue[0]))
    //                 $("#ekecamatan").prop("disabled", false)
    //             }
    //         });
    //     })
    //     $('#ekecamatan').on("click", function() {
    //         $("#ekalurahan").html("")
    //         $("#ekalurahan").prop("disabled", true)
    //         var selkec = $('#ekota').val()
    //         kalurahan.forEach(kalvalue => {
    //             if (selkec == kalvalue[2]) {
    //                 console.log(kalvalue[2])
    //                 $("#ekalurahan").append(new Option(kalvalue[1], kalvalue[0]))
    //                 $("#ekalurahan").prop("disabled", false)
    //                 $("#ekalurahan").val(kalvalue[0])
    //             }
    //         })
    //     })
    //     $("#formeditpa").on('submit', (function(e) {
    //         $("#formeditpabtn").button('loading');
    //         e.preventDefault();
    //         $.ajax({
    //             url: '<?php echo base_url(); ?>admin/patient/update',
    //             type: "POST",
    //             data: new FormData(this),
    //             dataType: 'json',
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             success: function(data) {
    //                 if (data.status == "fail") {
    //                     var message = "";
    //                     $.each(data.error, function(index, value) {
    //                         message += value;
    //                     });
    //                     errorMsg(message);
    //                 } else {
    //                     successMsg(data.message);
    //                     window.location.reload(true);
    //                 }
    //                 $("#formeditpabtn").button('reset');
    //             },
    //             error: function() {

    //             }
    //         });
    //     }));
    // });

    function delete_record(id) {
        if (confirm(<?php echo "'" . lang('Word.patient_delete_alert_message') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletePatient',
                type: "POST",
                data: {
                    delid: sbio.no_registration
                },
                dataType: 'json',
                success: function(data) {
                    successMsg(<?php echo "'" . lang('Word.delete_message') . "'"; ?>);
                    $("#rincianPasienModel").modal("hide");
                    table.ajax.reload();
                }
            })
        }
    }

    function CalculateAgeInQCe(DOB, txtAge, Txndate) {
        if (DOB.value != '') {
            now = new Date(Txndate)
            var txtValue = DOB;
            if (txtValue != null)
                dob = txtValue.split('/');
            if (dob.length === 3) {
                born = new Date(dob[2], dob[1] * 1 - 1, dob[0]);
                if (now.getMonth() == born.getMonth() && now.getDate() == born.getDate()) {
                    age = now.getFullYear() - born.getFullYear();
                } else {
                    age = Math.floor((now.getTime() - born.getTime()) / (365.25 * 24 * 60 * 60 * 1000));
                }
                if (isNaN(age) || age < 0) {

                } else {
                    if (now.getMonth() > born.getMonth()) {
                        var calmonth = now.getMonth() - born.getMonth();
                    } else {
                        var calmonth = born.getMonth() - now.getMonth();
                    }
                    $("#eage_year").val(age);
                    $("#eage_month").val(calmonth);
                    return age;
                }
            }
        }
    }
</script>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('#aprov').on("click", function() {
            $("#akota").html("")
            $("#akecamatan").html("")
            $("#akecamatan").prop("disabled", true)
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selprov = $('#aprov').val()
            kota.forEach(kotavalue => {
                if (kotavalue[0] == selprov) {
                    $("#akota").append(new Option(kotavalue[2], kotavalue[1]));
                    $("#akota").prop("disabled", false)
                }

            });
        })
        $('#akota').on("click", function() {
            $("#akecamatan").html("")
            $("#akecamatan").prop("disabled", true)
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selkota = $('#akota').val()
            kecamatan.forEach(kecvalue => {
                if (kecvalue[2] == selkota) {
                    $("#akecamatan").append(new Option(kecvalue[1], kecvalue[0]))
                    $("#akecamatan").prop("disabled", false)
                }
            });
        })
        $('#akecamatan').on("click", function() {
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selkec = $('#akota').val()
            kalurahan.forEach(kalvalue => {
                if (selkec == kalvalue[2]) {
                    console.log(kalvalue[2])
                    $("#akalurahan").append(new Option(kalvalue[1], kalvalue[0]))
                    $("#akalurahan").prop("disabled", false)
                    $("#akalurahan").val(kalvalue[0])
                }
            })
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(e) {

        $("#formaddpa").on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addpatient',
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
                        window.location.reload(true);
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
    });
</script>