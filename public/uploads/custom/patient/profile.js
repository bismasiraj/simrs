

function get_PatientDetails(id) {
    var base_url = "<?php echo base_url(); ?>backend/images/loading.gif";
    if (id == '') {} else {
        $.ajax({
            url: baseurl + 'admin/patient/getpatientDetails',
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    resetModal();
                    skunj = data
                    if (data.ismeninggal == 0) {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                    } else {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
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
                        if (skunj.kal_id == kalvalue[0]) {
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
                    $("#employee_id").html("");
                    var clinicSelected = 'P003';
                    dokterdpjp.forEach((value, key) => {
                        if (value[0] == clinicSelected) {
                            $("#employee_id").append(new Option(value[2], value[1]));
                        }
                    })


                    $("#pvdiantar_oleh").val(skunj.diantar_oleh);
                    $("#pvno_registration").val(skunj.no_registration);
                    $("#pvvisitor_address").val(skunj.visitor_address);
                    $("#pvorg_unit_code").val(skunj.org_unit_code);
                    $("#pvtgl_lahir").val(skunj.date_of_birth);
                    $("#pvgender").val(skunj.gender);
                    $("#pvpayor_id").val(skunj.payor_id);
                    $("#pvclinic_id_from").val("P000");
                    $("#pvclass_id_plafond").val(skunj.class_id);
                    $("#pvclass_id").val(skunj.class_id);
                    $("#booked_date").val(get_date());
                    $("#visit_date").val(get_date());
                    $("#status_pasien_id").val(skunj.status_pasien_id);
                    $("#clinic_id_from").val('P000');
                    $("#tanggal_rujukan").val(get_date());
                    $("#pvpasien_id").val(skunj.status_pasien_id);
                    var age = getAge(skunj.date_of_birth);
                    $("#pvageyear").val(age.years)
                    $("#pvagemonth").val(age.month)
                    $("#pvageday").val(age.days)
                    $("#pvcoverage_id").val(skunj.coverage_id)
                    $("#pvagama").val(skunj.kode_agama)
                    $("#pvaktif").val(skunj.aktif)
                    $("#pvfamily_status_id").val(skunj.family_status_id)

                    $("#kdpoli_eks").val(0)
                    $("#isnew").val(0)
                    $("#cob").val(0)
                    $("#way_id").val(17)
                    $("#way_id").val(17)
                    $("#isattended").val(0)

                    $("#formaddbtn").removeProp("disabled")
                    $("#formaddbtn_save_print").removeProp("disabled")


                    $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
                } else {}

                // holdModal('myModal');
                // patientvisit(data.no_registration);
            },
        });
    }

}