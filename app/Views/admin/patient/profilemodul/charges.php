<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();
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
<div class="tab-pane tab-content-height" id="charges" role="tabpanel">
    <div class="box-tab-header">
        <h3 class="box-tab-title">Tindakan</h3>
        <?php if (isset($permissions['tindakanpoli']['c'])) {
            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                <div class="box-tab-tools">
                    <a data-toggle="modal" onclick="holdModal('addBill')" class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                </div>
        <?php }
        } ?>
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <div class="box-header border-b mb10 pl-0 pt0">
                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"><?= $visit['diantar_oleh']; ?> (<?= $visit['no_registration']; ?>)</h3>
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
            <form id="form1" action="" method="post" class="">
                <div class="box-body row">
                    <input type="hidden" name="ci_csrf_token" value="">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Poli/Bangsal</label><small class="req"> *</small>
                            <select id="klinik" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                                <option value="%">Semua</option>
                                <?php $cliniclist = array();
                                foreach ($clinic as $key => $value) {
                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                                }
                                asort($cliniclist);
                                ?>
                                <?php foreach ($cliniclist as $key => $value) { ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <span class="text-danger" id="error_search_type"></span>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Relasi</label>
                            <select name="statuspasien" id="statuspasien" class="form-control">
                                <option value="%">Semua</option>
                                <?php foreach ($statusPasien as $key => $value) {
                                    if ($statusPasien[$key]['name_of_status_pasien'] != null && $statusPasien[$key]['name_of_status_pasien'] != '') {
                                ?>
                                        <option value="<?= $statusPasien[$key]['status_pasien_id']; ?>"><?= $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
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
                <table class="table table-bordered table-hove table-borderedcustom">
                    <thead style="text-align: center;">
                        <tr>
                            <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                            <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                            <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 2%;">Jml</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                            <th class="text-center" colspan="2" style="width: 20%;">Tanggungan pihak ke-3</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: auto;">Diskon</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Subsidi Satuan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Subsidi Total</th class="text-center">
                            <th class="text-center" rowspan="2"></th class="text-center">
                            <th class="text-center" rowspan="2"></th class="text-center">
                            <!-- <th class="text-center" rowspan="2">Jenis Pelayanan</th class="text-center">
                    <th class="text-center" rowspan="2">Pembulatan</th class="text-center">
                    <th class="text-center" colspan="15">Info Detil Billing</th class="text-center">
                    <th class="text-center" rowspan="2">Jenis Transaksi</th class="text-center">
                    <th class="text-center" rowspan="2">Tgl Keluar</th class="text-center">
                    <th class="text-center" rowspan="2">Keterangan</th class="text-center">
                    <th class="text-center" colspan="2">Rujukan Dari</th class="text-center">
                    <th class="text-center" rowspan="2">Ruang Rawat Inap</th class="text-center">
                    <th class="text-center" rowspan="2">Cara Keluar</th class="text-center">
                    <th class="text-center" rowspan="2">Tgl Cetak</th class="text-center">
                    <th class="text-center" rowspan="2">No Card</th class="text-center">
                    <th class="text-center" rowspan="2">Jenis Tenaga Medik</th class="text-center">
                    <th class="text-center" rowspan="2">Kasir</th class="text-center">
                    <th class="text-center" colspan="3">Modifikasi</th class="text-center">
                    <th class="text-center" colspan="3">Info Cetak</th class="text-center">
                    <th class="text-center" rowspan="2">ID Transaksi</th class="text-center">
                    <th class="text-center" rowspan="2">Closed Poli ID</th class="text-center">
                    <th class="text-center" rowspan="2">Locked Billing ID</th class="text-center">
                    <th class="text-center" rowspan="2">Setoran</th class="text-center"> -->
                        </tr>
                        <tr>
                            <th class="text-center">Nilai satuan</th class="text-center">
                            <th class="text-center">Total</th class="text-center">
                            <!-- <th class="text-center">Netto</th class="text-center">
                    <th class="text-center">tagihan</th class="text-center">
                    <th class="text-center">Diskon</th class="text-center">
                    <th class="text-center">potongan</th class="text-center">
                    <th class="text-center">subsidi</th class="text-center">
                    <th class="text-center">pembayaran</th class="text-center">
                    <th class="text-center">retur</th class="text-center">
                    <th class="text-center">Nilai PPN</th class="text-center">
                    <th class="text-center">Koreksi</th class="text-center">
                    <th class="text-center">Embalace</th class="text-center">
                    <th class="text-center">Biaya Jasa</th class="text-center">
                    <th class="text-center">Jenis Tarif</th class="text-center">
                    <th class="text-center">PPN</th class="text-center">
                    <th class="text-center">Pokok jual</th class="text-center">
                    <th class="text-center">Margin</th class="text-center">
                    <th class="text-center">Pelayanan</th class="text-center">
                    <th class="text-center">Dokter</th class="text-center">
                    <th class="text-center">oleh</th class="text-center">
                    <th class="text-center">Tanggal</th class="text-center">
                    <th class="text-center">Dari</th class="text-center">
                    <th class="text-center">Oleh</th class="text-center">
                    <th class="text-center">tanggal</th class="text-center">
                    <th class="text-center">Ke</th class="text-center"> -->
                        </tr>
                    </thead>
                    <tbody id="chargesBody">
                        <?php
                        $total = 0;

                        ?>


                    </tbody>

                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Total" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="tagihan_total" name="tagihan_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Total Subsidi/Tanggungan/Piutang Pihak Ketiga" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="subsidi_total" name="subsidi_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Total Potongan" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="potongan_total" name="potongan_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Pembulatan" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="pembulatan_total" name="pembulatan_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Total Pelunasan/Angsuran/Titipan/Deposit" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="pelunasan_total" name="pelunasan_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Total Retur Pembayaran" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="retur_total" name="pembayaran_total" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right">
                            <h3><?php echo "Tagihan" . " : " . $currency_symbol . ""; ?><input type="text" id="totalnya" name="totalnya" disabled></h3>

                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="box box-solid total-bg">

                        <td colspan='11' class="text-right"><?php echo "Tarif INACBG" . " : " . $currency_symbol . ""; ?>
                            <input type="text" id="inacbg" name="inacbg" disabled>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                </table>
            </div>
        </div>
    </div><!--./row-->
</div><!--#/charges-->
<!-- -->



<script type='text/javascript'>
    var inacbg = 0.0;
    var billJson;
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

        getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
        getResep(visit, nomor)
        getInacbg(visit)
        getHasilLab(nomor, visit)
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

    function getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getBillPoli',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'ke': ke,
                'mulai': mulai,
                'akhir': akhir,
                'lunas': lunas,
                'klinik': klinik,
                'rj': rj,
                'status': status,
                'nota': nota,
                'trans': trans
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                billJson = data


                billJson.forEach((element, key) => {

                    billJson[key].sell_price = parseFloat(billJson[key].sell_price)
                    // if (!isnullcheck(billJson[key].quantity))
                    //     billJson[key].quantity = parseFloat((billJson[key].quantity))
                    // else
                    //     billJson[key].quantity = 0
                    billJson[key].quantity = isnullcheck(billJson[key].quantity)
                    billJson[key].amount_paid = isnullcheck(billJson[key].amount_paid)

                    billJson[key].amount_plafond = parseFloat(billJson[key].amount_plafond)
                    billJson[key].amount_paid_plafond = parseFloat(billJson[key].amount_paid_plafond)
                    billJson[key].discount = parseFloat(billJson[key].discount)
                    billJson[key].subsidisat = parseFloat(billJson[key].subsidisat)
                    billJson[key].subsidi = parseFloat(billJson[key].subsidi)
                    billJson[key].potongan = parseFloat(isnullcheck(billJson[key].potongan))
                    billJson[key].pembulatan = parseFloat(isnullcheck(billJson[key].pembulatan))
                    billJson[key].bayar = parseFloat(isnullcheck(billJson[key].bayar))
                    billJson[key].retur = parseFloat(isnullcheck(billJson[key].retur))
                    billJson[key].tagihan = parseFloat(isnullcheck(billJson[key].tagihan))
                    billJson[key].quantity = parseFloat(isnullcheck(billJson[key].quantity))
                    billJson[key].amount_paid = parseFloat((billJson[key].amount_paid))

                    tagihan += parseFloat(billJson[key].tagihan)

                    //  sum(if(isnull(subsidi),0,subsidi) for all)
                    subsidi += billJson[key].subsidi

                    //  sum(if(isnull(potongan),0,potongan) for all)
                    potongan += billJson[key].potongan

                    // sum(pembulatannya for all)
                    pembulatan += billJson[key].pembulatan

                    // sum(if(isnull(bayar),0,bayar) for all)
                    pembayaran += billJson[key].bayar

                    // sum(if(isnull(retur),0,retur) for all)
                    retur += billJson[key].retur

                    // total_tagihan  - (total_subsidi + total_potongan) + bulat - total_lunas +total_retur_bayar 

                    var keterangan = '';

                    // if(isnull(keterangan),'',if((tarif = '0005002' or tarif='0004002'), invoice_id +' ' +module_id+'~r~n '+ 'No. : ' + account_id,keterangan)) +  if(isnull(nama_dokter),'',nama_dokter) 
                    if (billJson[key].keterangan == null) {
                        keternagan = ''
                    } else {
                        if (billJson[key].tarif_id == '0005002' || billJson[key].tarif_id == '0004002') {
                            keterangan = billJson[key].invoice_id + ' ' + billJson[key].module_id + '~r~n ' + 'No. : ' + billJson[key].account_id;
                        } else {
                            keterangan = billJson[key].keterangan;
                        }
                    }
                    if (billJson[key].doctor != null) {
                        keterangan += billJson[key].doctor;
                    }

                    // if(lunas='1','VALID-LOCK!',if(lunas ='2','CLOSE!',if(lunas = '5','Close Billing!','OPEN!')))
                    var lunas = '';
                    if (billJson[key].islunas == '1') {
                        lunas = 'VALID-LOCK!';
                    } else if (billJson[key].islunas == '2') {
                        lunas = 'CLOSE!';
                    } else if (billJson[key].islunas == '5') {
                        lunas = 'Close Billing!';
                    } else {
                        lunas = 'OPEN!';
                    }

                    $("#chargesBody").append($("<tr>")
                        .append($("<td>").html(String(key + 1) + "."))
                        .append($("<td>").attr("id", "treatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                        .append($("<td>").attr("id", "treat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                        // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                        .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                        .append($("<td>").attr("id", "quantity" + key).html(formatCurrency(billJson[key].quantity)).append($("<p>").html(billJson[key].name_of_status_pasien)))
                        .append($("<td>").attr("id", "amount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                        .append($("<td>").attr("id", "amount_plafond" + key).html((billJson[key].amount_plafond)))
                        .append($("<td>").attr("id", "amount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                        .append($("<td>").attr("id", "discount" + key).html(formatCurrency(billJson[key].discount)))
                        .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                        .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidi)))
                        .append($("<td>").append('<button type="button" onclick="" class="editbtn" data-row-id="1" autocomplete="off"><i class="fa fa-edit"></i></button>'))
                        .append($("<td>").append('<button type="button" onclick="" class="closebtn" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))


                    )

                    if (billJson[key].clinic_id == 'P016') {
                        $("#radBody").append($("<tr>")
                            .append($("<td>").html(billJson[key].tarif_id))
                            .append($("<td>").html(billJson[key].treatment))
                            .append($("<td>").html(billJson[key].treat_date))
                            .append($("<td>").html(billJson[key].doctor))
                            .append($("<td>").html(billJson[key].nota_no))
                            .append($("<td>").append('<button type="button" onclick="getTreatResult(\'' + billJson[key].no_registration + '\',\'' + billJson[key].visit_id + '\',\'' + billJson[key].tarif_id + '\')" class="editbtn" data-row-id="1" autocomplete="off"><i class="fa fa-edit"></i></button>'))


                        )
                    }



                });
                total += tagihan - (subsidi + potongan) + pembulatan - pembayaran + retur;
                $("#tagihan_total").val(formatCurrency(tagihan));
                $("#subsidi_total").val(formatCurrency(subsidi));
                $("#potongan_total").val(formatCurrency(potongan));
                $("#pembulatan_total").val(formatCurrency(pembulatan));
                $("#pelunasan_total").val(formatCurrency(pembayaran));
                $("#retur_total").val(formatCurrency(retur));
                $("#totalnya").val(formatCurrency(total));
            },
            error: function() {

            }
        });
    }

    function getInacbg(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getInacbg',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                billJson = data


                billJson.forEach((element, key) => {

                    inacbg = parseFloat(billJson[key].cbg_tarif)
                    $("#inacbg").val(formatCurrency(inacbg));

                });
            },
            error: function() {

            }
        });
    }
</script>