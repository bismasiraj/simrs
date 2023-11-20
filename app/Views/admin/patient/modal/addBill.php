<div class="modal fade" id="addBill" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <form id="formaddbill" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                    <input name="trans_id" id="atrans_id" type="hidden" class="form-control" />
                    <input name="no_registration" id="ano_registration" type="hidden" class="form-control" />
                    <input name="theorder" id="atheorder" type="hidden" class="form-control" />
                    <input name="visit_id" id="akunjungan" type="hidden" class="form-control" />
                    <input name="org_unit_code" id="aorg_unit_code" type="hidden" class="form-control" />
                    <input name="class_id_plafond" id="aclass_id_plafond" type="hidden" class="form-control" />
                    <input name="payor_id" id="apayor_id" type="hidden" class="form-control" />
                    <input name="karyawan" id="akaryawan" type="hidden" class="form-control" />
                    <input name="theid" id="atheid" type="hidden" class="form-control" />
                    <input name="thename" id="athename" type="hidden" class="form-control" />
                    <input name="theaddress" id="atheaddress" type="hidden" class="form-control" />
                    <input name="status_pasien_id" id="astatus_pasien_id" type="hidden" class="form-control" />
                    <input name="isRJ" id="aisRJ" type="hidden" class="form-control" />
                    <input name="gender" id="agender" type="hidden" class="form-control" />
                    <input name="ageyear" id="aageyear" type="hidden" class="form-control" />
                    <input name="agemonth" id="aagemonth" type="hidden" class="form-control" />
                    <input name="ageday" id="aageday" type="hidden" class="form-control" />
                    <input name="kal_id" id="akal_id" type="hidden" class="form-control" />
                    <input name="karyawan" id="akaryawan" type="hidden" class="form-control" />

                    <input name="class_room_ID" id="aclass_room_ID" type="hidden" class="form-control" />
                    <input name="bed_id" id="abed_id" type="hidden" class="form-control" />
                    <input name="employee_id_from" id="aemployee_id_from" type="hidden" class="form-control" />
                    <input name="doctor_from" id="adoctor_from" type="hidden" class="form-control" />

                    <input name="clinic_id" id="aclinic_id" type="hidden" class="form-control" />
                    <input name="clinic_id_from" id="aclinic_id_from" type="hidden" class="form-control" />
                    <input name="treat_date" id="atreat_date" type="hidden" class="form-control" />
                    <input name="exit_date" id="aexit_date" type="hidden" class="form-control" />
                    <input name="cashier" id="acashier" type="hidden" class="form-control" />
                    <input name="modified_from" id="aoleh" type="hidden" class="form-control" />




                    <input name="islunas" id="aislunas" type="hidden" class="form-control" />
                    <input name="measure_id" id="ameasure_id" type="hidden" class="form-control" />
                    <input name="tarif_id" id="atarif_id" type="hidden" class="form-control" />


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-header border-b mb-10 pl-0 pt0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Tarif</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="form-group"><label for="employee_id">Dokter</label>
                                    <div>
                                        <select name='employee_id' id="aemployee_id" class="form-control select2 act" style="width:100%">
                                            <?php $dokterlist = array();
                                            foreach ($schedule as $key => $value) {
                                                $dokterlist[$schedule[$key]['employee_id']] = $schedule[$key]['fullname'];
                                            }
                                            asort($dokterlist);
                                            ?>
                                            <?php foreach ($dokterlist as $key => $value) { ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <div class="form-group"><label>Jenis Tindakan</label><input type="text" name="treatment" id="atreatment" placeholder="" value="" class="form-control" readonly></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-2"><label>Nilai</label><input type="text" name="sell_price" id="asell_price" placeholder="" value="" class="form-control" readonly></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-2"><label>Jml</label><input type="text" name="quantity" id="aquantity" placeholder="" value="" class="form-control" onfocus="this.value=''"></div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="form-group mb-2"><label>Total Tagihan</label><input type="text" name="amount_paid" id="aamount_paid" placeholder="" value="" class="form-control" readonly></div>
                            </div>
                            <div class="accordion m-4" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Rincian
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Diskon</label><input type="text" name="discount" id="adiscount" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Subsidi Satuan</label><input type="text" name="subsidisat" id="asubsidisat" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Netto</label><input type="text" name="amount" id="aamount" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>tagihan</label><input type="text" name="tagihan" id="atagihan" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>subsidi</label><input type="text" name="subsidi" id="asubsidi" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Biaya Jasa</label><input type="text" name="profesi" id="aprofesi" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Jenis Tarif</label><input type="text" name="tarif_type" id="atarif_type" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group mb-2"><label>Kelas</label><input type="text" name="class_id" id="aclass_id" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Tarif Sesuai Hak Kelas
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-muted">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label>Tarif Satuan Kelas</label><input type="text" name="" id="aamount_plafond" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label>Total Tagihan</label><input type="text" name="" id="aamount_paid_plafond" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label>Hak Kelas</label><input type="text" name="" id="aclass_id_plafond" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                                <input name="tarif_id_plafond" id="atarif_id_plafond" type="hidden" class="form-control" />
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label>Nama Tarif</label><input type="text" name="" id="atreatment_plafond" placeholder="" value="" class="form-control" readonly></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="pull-right">
                        <button type="submit" id="formaddbill" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" id="formaddbill" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                </div>
            </div> -->
        </div>
    </div>
</div>


<script type="text/javascript">
    var statusPasien = '<?= $visit['status_pasien_id']; ?>';

    $("#aemployee_id").val('<?= $visit['employee_id']; ?>');

    $("#aquantity").keydown(function(e) {
        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();

    });

    $('#aquantity').on("input", function() {
        var dInput = this.value;
        console.log(dInput);
        $("#aamount_paid").val($("#aamount").val() * dInput)
        $("#atagihan").val($("#aamount").val() * dInput)
        $("aamount_paid_plafond").val($("#aamount_plafond").val() * dInput)

    });


    $(document).ready(function(e) {
        initializeSearchTarif("searchTarif")
        // $('#searchTarif').select2({
        //     ajax: {
        //         url: '<?= base_url(); ?>admin/patient/getTarif',
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term, // search term
        //                 klinik: '<?= $visit['clinic_id']; ?>',
        //                 kelas: '<?= $visit['class_id']; ?>'
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }
        // });
    })

    function addBill() {
        setTarif()
        $("#addBill").modal("show")
    }

    function setTarif() {
        tarifDataJson = $("#searchTarif").val();
        tarifData = JSON.parse(tarifDataJson);

        // alert(tarifDataJson);

        $("#atrans_id").val('<?= $visit['trans_id']; ?>');
        $("#ano_registration").val('<?= $visit['no_registration']; ?>');
        $("#atheorder").val(billJson.length + 1);
        $("#akunjungan").val('<?= $visit['visit_id']; ?>');
        $("#aorg_unit_code").val('<?= $visit['org_unit_code']; ?>');
        $("#aclass_id_plafond").val('<?= $visit['class_id_plafond']; ?>');
        $("#apayor_id").val('<?= $visit['payor_id']; ?>');
        $("#akaryawan").val('<?= user_id(); ?>');
        $("#atheid").val('<?= $visit['pasien_id']; ?>');
        $("#athename").val('<?= $visit['diantar_oleh']; ?>');
        $("#atheaddress").val('<?= $visit['visitor_address']; ?>');
        $("#astatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>');
        $("#aisRJ").val('<?= $visit['isrj']; ?>');
        $("#agender").val('<?= $visit['gender']; ?>');
        $("#aageyear").val('<?= $visit['ageyear']; ?>');
        $("#aagemonth").val('<?= $visit['agemonth']; ?>');
        $("#aageday").val('<?= $visit['ageday']; ?>');
        $("#akal_id").val('<?= $visit['kal_id']; ?>');
        $("#akaryawan").val('<?= $visit['karyawan']; ?>');

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_ID").val('<?= $visit['class_room_id']; ?>');
            $("#abed_id").val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                echo '$("#aemployee_id_from").val("' . $visit['employee_id_from'] . '");';
                echo '$("#adoctor_from").val("' . $visit['fullname_from'] . '");';
            } else {
                echo '$("#aemployee_id_from").val("' . $visit['employee_inap'] . '");';
                echo '$("#adoctor_from").val("' . $visit['fullname_inap'] . '");';
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                echo '$("#aemployee_id_from").val("' . $visit['employee_id_from'] . '");';
                echo '$("#adoctor_from").val("' . $visit['fullname_from'] . '");';
            } else {
                echo '$("#aemployee_id_from").val("' . $visit['employee_id'] . '");';
                echo '$("#adoctor_from").val("' . $visit['fullname'] . '");';
            }
            ?>
        }

        $("#aclinic_id").val('<?= $visit['clinic_id']; ?>');
        $("#aclinic_id_from").val('<?= $visit['clinic_id_from']; ?>');
        $("#atreat_date").val(get_date());
        $("#aexit_date").val(get_date());
        $("#acashier").val('<?= user_id(); ?>');
        $("#aoleh").val('<?= user_id(); ?>');

        $("#amodified_from").val('<?= $visit['clinic_id']; ?>');






        $("#atarif_id").val(tarifData.tarif_id)
        $("#atarif_name").val(tarifData.tarif_name)
        $("#atreatment").val(tarifData.tarif_name)
        $("#aamount").val(tarifData.amount)
        $("#asell_price").val(tarifData.amount)
        // $("kal_id").val(tarifData.kal_id)
        $("#aclass_id").val(tarifData.class_id)
        $("#atarif_type").val(tarifData.tarif_type)
        $("#aquantity").val(1)

        $subsidi = hitungSubsidi(statusPasien, tarifData.tarif_id, tarifData.amount) * $("#aquantity").val();
        $("subsidi").val(subsidi)
        $("subsidisat").val(subsidi)
        $("discount").val(0)

        $("#aamount_paid").val(tarifData.amount * $("#aquantity").val())
        $("#aislunas").val('0')
        $("#atagihan").val(tarifData.amount * $("#aquantity").val())

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("aamount_plafond").val(tarifKelas)
                $("aamount_paid_plafond").val(tarifKelas * $("#aquantity").val())
                $("aclass_id_plafond").val('<?= $visit['class_id_plafond']; ?>')
                $("atarif_id_plafond").val(tarifData.tarif_id)
                $("atreatment_plafond").val(tarifData.tarif_name)

            }
        }

    }

    function hitungSubsidi(status, tarif, biaya) {
        var diskon = setDiskon(status, tarif);

        if (diskon > 1) {
            diskon = diskon;
        } else if (diskon <= 1 && diskon > 0) {
            diskon *= biaya;
        } else {
            diskon = 0
        }

        return diskon;
    }

    function setDiskon(status, tarif) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getDiskon',
            type: "POST",
            data: JSON.stringify({
                'status': status,
                'tarif': tarif,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                return data;
            },
            error: function() {

            }
        });
    }

    function hitungPotongan(status, tarif, biaya) {


    }

    function getPlafond(classPlafond, tarifName, isCito) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getPlafond',
            type: "POST",
            data: JSON.stringify({
                'classPlafond': classPlafond,
                'tarifName': tarifName,
                'isCito': isCito
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                return data;
            },
            error: function() {

            }
        });
    }
    var amountTagihan;
    var totalAfter
    $("#formaddbill").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        amountTagihan = parseFloat($("#atagihan").val());
        totalAfter = total + amountTagihan;

        if (inacbg > 0 && totalAfter > inacbg) {
            if (confirm('Total tagihan akan melebihi tarif inacbg, apakah anda masih ingin melanjutkan?') == true) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/addBill',
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

                            var billId = data.billId;

                            var nomor = '<?= $visit['no_registration']; ?>';
                            var ke = '%'
                            var mulai = '2023-08-01' //tidak terpakai
                            var akhir = '2023-08-31' //tidak terpakai
                            var lunas = '%'
                            // var klinik = '<?= $visit['clinic_id']; ?>'
                            var klinik = '%'
                            var rj = '%'
                            var status = '%'
                            var nota = '%'
                            var trans = '<?= $visit['trans_id']; ?>'

                            billJson = [];
                            $("#chargesBody").html("");
                            tagihan = 0.0;
                            subsidi = 0.0;
                            potongan = 0.0;
                            pembulatan = 0.0;
                            pembayaran = 0.0;
                            retur = 0.0;
                            total = 0.0;
                            lastOrder = 0;

                            getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans);

                            $("#addBill").modal('hide');
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
            }
        } else {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addBill',
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

                        var billId = data.billId;

                        var nomor = '<?= $visit['no_registration']; ?>';
                        var ke = '%'
                        var mulai = '2023-08-01' //tidak terpakai
                        var akhir = '2023-08-31' //tidak terpakai
                        var lunas = '%'
                        // var klinik = '<?= $visit['clinic_id']; ?>'
                        var klinik = '%'
                        var rj = '%'
                        var status = '%'
                        var nota = '%'
                        var trans = '<?= $visit['trans_id']; ?>'

                        billJson = [];
                        $("#chargesBody").html("");
                        tagihan = 0.0;
                        subsidi = 0.0;
                        potongan = 0.0;
                        pembulatan = 0.0;
                        pembayaran = 0.0;
                        retur = 0.0;
                        total = 0.0;
                        lastOrder = 0;

                        getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans);

                        $("#addBill").modal('hide');
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
        }


    }));

    function postingAddBill() {

    }
</script>