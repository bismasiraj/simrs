<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="mrpasien" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <div>
                <h4><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h4>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4 table-biodata-header">

                    <?php

                    if ($visit['gender'] == '1') {
                        $file = "uploads\images\profile_male.png";
                    } else if ($visit['gender'] == '2') {
                        $file = "uploads\images\profile_female.png";
                    }

                    ?>
                    <img width="115" height="115" class="rounded-circle avatar-lg" src="<?php echo base_url(); ?><?php echo $file ?>">

                </div><!--./col-lg-5-->
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table">
                        <tr>
                            <td class="bolds"><?php echo lang('Word.age'); ?></td>
                            <td id="age"><?= $visit['age']; ?></td>
                        </tr>
                        <tr>
                            <td class="bolds">Alamat</td>
                            <td id="address"><?php echo $visit['visitor_address']; ?></td>
                        </tr>

                        <tr>
                            <td class="bolds">Dokter</td>
                            <td id="dokter"><?php echo $visit['fullname']; ?></td>
                        </tr>
                        <?php if (!is_null($visit['class_room_id'])) { ?>
                            <tr>
                                <td class="bolds">Tanggal Masuk</td>
                                <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                            </tr>
                            <tr>
                                <td class="bolds">Tanggal Keluar</td>
                                <td id="exit_date"><?php echo $visit['exit_date']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="bolds">Tanggal</td>
                                <td id="visit_date"><?php echo $visit['visit_date']; ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <?php if (!is_null($visit['class_room_id'])) { ?>
                                <td class="bolds">Bangsal</td>
                                <td id="klinik"><?php echo ($visit['name_of_class']); ?></td>
                            <?php } else { ?>
                                <td class="bolds">Poli</td>
                                <td id="klinik"><?php echo $visit['name_of_clinic']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="bolds">Alergi</td>
                            <td class="alergi"> - </td>
                        </tr>


                    </table>
                </div><!--./col-lg-7-->
            </div><!--./row-->


            <?php if (!empty($pasienDiagnosa)) {
            ?>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                <ul>
                    <li>
                        <div class="rmdescription"><?= $pasienDiagnosa['description']; ?></div>
                    </li>
                    <li>
                        <div><?= $pasienDiagnosa['diagnosa_desc_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                <ul>
                    <li>
                        <div class="rmdiagnosa_desc_06"><?= $pasienDiagnosa['diagnosa_desc_06']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                <ul>
                    <li>
                        <div class="rmanamnase"><?= $pasienDiagnosa['anamnase']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan"><?= $pasienDiagnosa['pemeriksaan']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_02"><?= $pasienDiagnosa['pemeriksaan_02']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_03"><?= $pasienDiagnosa['pemeriksaan_03']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                <ul>
                    <li>
                        <div class="rmpemeriksaan_05"><?= $pasienDiagnosa['pemeriksaan_05']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                <ul>
                    <li>
                        <div class="rmteraphy_desc"><?= $pasienDiagnosa['teraphy_desc']; ?></div>
                    </li>
                </ul>
                <hr class="hr-panel-heading hr-10">
                <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                <ul>
                    <li>
                        <div class="rminstruction"><?= $pasienDiagnosa['instruction']; ?></div>
                    </li>
                </ul>
            <?php
            } ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">


            <div class="download_label"><?php echo $visit['diantar_oleh'] . " " . lang('opd_details'); ?></div>
            <div class="table-responsive">
                <style>
                    th {
                        width: 200px;
                    }

                    #chargesBody td {
                        text-align: center;
                    }

                    #chargesBody p {
                        color: cadetblue;
                    }
                </style>
                <table class="table table-borderedcustom table-bordered table-hover">
                    <thead style="text-align: center;">
                        <tr>
                            <th class="text-center" rowspan="2" style="width: 20%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Poliklinik</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">SOAP</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">Instruksi Pengobatan / Tindakan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Petugas DPJP</th class="text-center">
                        </tr>

                    </thead>
                    <tbody id="mrBody">
                        <?php
                        $total = 0;

                        ?>


                    </tbody>

                </table>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->



<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    $(document).ready(function(e) {
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
        var visit = '<?= $visit['visit_id']; ?>'

        getMrPasien(nomor)
    })
</script>
<script type='text/javascript'>
    function formatCurrency(total) {
        //Seperates the components of the number
        var components = total.toFixed(2).toString().split(".");
        //Comma-fies the first part
        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        //Combines the two sections
        return components.join(",");
    }


    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getMrPasien(nomor) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getMrPasien',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                mrJson = data


                mrJson.forEach((element, key) => {

                    $("#mrBody").append($("<tr>")
                        .append($("<td>").append($("<p>").html(mrJson[key].date_of_diagnosa)))
                        .append($("<td>").html(mrJson[key].name_of_clinic))
                        .append($("<td>").append($("<p>").html("<b>S</b>: " + mrJson[key].anamnase)).append($("<p>").html("<b>O</b>: " + mrJson[key].pemeriksaan)).append($("<p>").html("<b>A</b>: " + mrJson[key].pemeriksaan_02)).append($("<p>").html("<b>P</b>: " + mrJson[key].pemeriksaan_03)).append($("<p>").html(mrJson[key].diagnosa_id + '-' + mrJson[key].diagnosa_desc)))
                        .append($("<td>").append($("<p>").html(mrJson[key].teraphy_desc)).append($("<p>").html(mrJson[key].instruction)))
                        .append($("<td>").html(mrJson[key].fullname))
                    )



                });
            },
            error: function() {

            }
        });
    }
</script>