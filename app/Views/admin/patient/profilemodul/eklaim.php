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
<div class="tab-pane" id="klaim" role="tabpanel">
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


            <style>
                .persalinanHead {
                    color: #fff;
                    background-color: #62a4e6;
                    border-color: #62a4e6;
                }

                .persalinanBody {
                    border: 1px solid #62a4e6;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #75798B;
                }

                .persalinanBodyLeft {
                    border-top: 1px solid #62a4e6;
                    border-left: 1px solid #62a4e6;
                    border-bottom: 1px solid #62a4e6;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #75798B;
                }

                .persalinanBodyMiddle {
                    border-top: 1px solid #62a4e6;
                    border-bottom: 1px solid #62a4e6;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #75798B;
                }

                .persalinanBodyRight {
                    border-top: 1px solid #62a4e6;
                    border-right: 1px solid #62a4e6;
                    border-bottom: 1px solid #62a4e6;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #75798B;
                }
            </style>
        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <form id="formeklaim" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="ekcurrentStep" name="currentStep" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ektrans_id" name="trans_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ekvisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eknosep" name="nosep" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eknosep_inap" name="nosep_inap" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eknomor_rm" name="nomor_rm" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eknama_pasien" name="nama_pasien" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ektgl_lahir" name="tgl_lahir" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ekgender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ekpayor_id" name="payor_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ekpayor_cd" name="payor_cd" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="eknama_dokter" name="nama_dokter" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ektarif_poli_eks" name="tarif_poli_eks" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="ekkode_tarif" name="kode_tarif" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <!-- <input id="eknama_dokter" name="nama_dokter" placeholder="" type="text" class="form-control block" value="" style="display: none" /> -->

                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <table class="table tablecustom table-bordered mb0">
                                    <tbody>
                                        <tr>
                                            <td>No. SEP</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="nomor_sep" id="eknomor_sep" placeholder="" value="" class="form-control"></td>
                                            <td>No. Kartu</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="nomor_kartu" id="eknomor_kartu" placeholder="" value="" class="form-control"></td>
                                            <td>Jaminan / Cara Bayar</td>
                                            <td>
                                                <select name="payor" id="ekpayor" class="form-control">
                                                    <option value="3-JKN">JKN</option>
                                                    <option value="71-COVID-19">JAMINAN COVID-19</option>
                                                    <option value="72-KIPI">JAMINAN KIPI</option>
                                                    <option value="73-BBL">JAMINAN BAYI BARU LAHIR</option>
                                                    <option value="74-PMR">JAMINAN PERPANJANGAN MASA RAWAT</option>
                                                    <option value="75-CO-INS">JAMINAN CO-INSIDENSE</option>
                                                    <option value="76-JPS">JAMPERSAL</option>
                                                    <option value="77-JPKP">JAMINAN PEMULIHAN KESEHATAN PRIORITAS</option>
                                                    <option value="5-1">JAMKESDA</option>
                                                    <option value="6-JKS">JAMKESOS</option>
                                                    <option value="1-999">PASIEN BAYAR</option>
                                                </select>
                                            </td>
                                            <td>COB</td>
                                            <td>
                                                <select name="cob_cd" id="ekcob_cd" class="form-control">
                                                    <option value="-">-</option>
                                                    <option value="1">MANDIRI INHEALTH</option>
                                                    <option value="5">ASURANSI SINAR MAS</option>
                                                    <option value="6">ASURANSI TUGU MANDIRI</option>
                                                    <option value="7">ASURANSI MITRA MAPARYA</option>
                                                    <option value="8">ASURANSI AXA MANDIRI FINANSIAL SERVICE</option>
                                                    <option value="9">ASURANSI AXA FINANSIAL INDONESIA</option>
                                                    <option value="10">LIPPO GENERAL INSURANCE</option>
                                                    <option value="11">ARTHAGRAHA GENERAL INSURANSE</option>
                                                    <option value="12">TUGU PRATAMA INDONESIA</option>
                                                    <option value="13">ASURANSI BINA DANA ARTA</option>
                                                    <option value="14">ASURANSI JIWA SINAR MAS MSIG</option>
                                                    <option value="15">AVRIST ASSURANCE</option>
                                                    <option value="16">ASURANSI JIWA SRAYA</option>
                                                    <option value="17">ASURANSI JIWA CENTRAL ASIA RAYA</option>
                                                    <option value="18">ASURANSI TAKAFUL KELUARGA</option>
                                                    <option value="19">ASURANSI JIWA GENERALI INDONESIA</option>
                                                    <option value="20">ASURANSI ASTRA BUANA</option>
                                                    <option value="21">ASURANSI UMUM MEGA</option>
                                                    <option value="22">ASURANSI MULTI ARTHA GUNA</option>
                                                    <option value="23">ASURANSI AIA INDONESIA</option>
                                                    <option value="24">ASURANSI JIWA EQUITY LIFE INDONESIA</option>
                                                    <option value="25">ASURANSI JIWA RECAPITAL</option>
                                                    <option value="26">GREAT EASTERN LIFE INDONESIA</option>
                                                    <option value="27">ASURANSI ADISARANA WANAARTHA</option>
                                                    <option value="28">ASURANSI JIWA BRINGIN JIWA SEJAHTERA</option>
                                                    <option value="29">BOSOWA ASURANSI</option>
                                                    <option value="30">MNC LIFE ASSURANCE</option>
                                                    <option value="31">ASURANSI AVIVA INDONESIA</option>
                                                    <option value="32">ASURANSI CENTRAL ASIA RAYA</option>
                                                    <option value="33">ASURANSI ALLIANZ LIFE INDONESIA</option>
                                                    <option value="34">ASURANSI BINTANG</option>
                                                    <option value="35">TOKIO MARINE LIFE INSURANCE INDONESIA</option>
                                                    <option value="36">MALACCA TRUST WUWUNGAN</option>
                                                    <option value="37">ASURANSI JASA INDONESIA</option>
                                                    <option value="38">ASURANSI JIWA MANULIFE INDONESIA</option>
                                                    <option value="39">ASURANSI BANGUN ASKRIDA</option>
                                                    <option value="40">ASURANSI JIWA SEQUIS FINANCIAL</option>
                                                    <option value="41">ASURANSI AXA INDONESIA</option>
                                                    <option value="42">BNI LIFE</option>
                                                    <option value="43">ACE LIFE INSURANCE</option>
                                                    <option value="44">CITRA INTERNATIONAL UNDERWRITERS</option>
                                                    <option value="45">ASURANSI RELIANCE INDONESIA</option>
                                                    <option value="46">HANWHA LIFE INSURANCE INDONESIA</option>
                                                    <option value="47">ASURANSI DAYIN MITRA</option>
                                                    <option value="48">ASURANSI ADIRA DINAMIKA</option>
                                                    <option value="49">PAN PASIFIC INSURANCE</option>
                                                    <option value="50">ASURANSI SAMSUNG TUGU</option>
                                                    <option value="51">ASURANSI UMUM BUMI PUTERA MUDA 1967</option>
                                                    <option value="52">ASURANSI JIWA KRESNA</option>
                                                    <option value="53">ASURANSI RAMAYANA</option>
                                                    <option value="54">VICTORIA INSURANCE</option>
                                                    <option value="55">ASURANSI JIWA BERSAMA BUMIPUTERA 1912</option>
                                                    <option value="56">FWD LIFE INDONESIA</option>
                                                    <option value="57">ASURANSI TAKAFUL KELUARGA</option>
                                                    <option value="58">ASURANSI TUGU KRESNA PRATAMA</option>
                                                    <option value="59">SOMPO INSURANCE</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <h3>
                                    Parameter Klaim
                                </h3>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <table class="table tablecustom table-bordered mb0">
                                    <tbody>
                                        <tr>
                                            <td>Jenis Rawat</td>
                                            <td>
                                                <select name="jenis_rawat" id="ekjenis_rawat" class="form-control">
                                                    <option value="1">Rawat Inap</option>
                                                    <option value="2">Rawat Jalan</option>
                                                    <option value="3">IGD</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php if ($visit['no_skpinap'] == '' || is_null($visit['no_skpinap'])) { ?>
                                                <td>Poli Eksekutif</td>
                                                <td>
                                                    <select name="kelas_rawat" id="ekkelas_rawat" class="form-control">
                                                        <option value="3">Regular</option>
                                                        <option value="1">Eksekutif</option>
                                                    </select>
                                                </td>
                                            <?php } else { ?>
                                                <td>Kelas Hak</td>
                                                <td>
                                                    <select name="kelas_rawat" id="ekkelas_rawat" class="form-control">
                                                        <option value="3">Kelas 3</option>
                                                        <option value="2">Kelas 2</option>
                                                        <option value="1">Kelas 1</option>
                                                    </select>
                                                </td>
                                            <?php } ?>


                                        </tr>
                                        <tr>

                                            <td>Tanggal Masuk</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="tgl_masuk" id="ektgl_masuk" placeholder="" value="" class="form-control"></td>

                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#ektgl_masuk').datetimepicker({
                                                        format: 'YYYY-MM-DD hh:ss'
                                                    });
                                                });
                                            </script>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Keluar</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="tgl_pulang" id="ektgl_pulang" placeholder="" value="" class="form-control"></td>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#ektgl_pulang').datetimepicker({
                                                        format: 'YYYY-MM-DD hh:ss'
                                                    });
                                                });
                                            </script>
                                        </tr>
                                        <tr>
                                            <td>Berat Lahir</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="birth_weight" id="ekbirth_weight" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <table class="table tablecustom table-bordered mb0">
                                    <tbody>
                                        <tr>
                                            <td>Cara Masuk</td>
                                            <td colspan="3">
                                                <select name="cara_masuk" id="ekcara_masuk" class="form-control">
                                                    <option value="gp">Rujukan FKTP</option>
                                                    <option value="hosp-trans">Rujukan FKRTL</option>
                                                    <option value="mp">Rujukan Spesialis</option>
                                                    <option value="outp">Dari Rawat Jalan</option>
                                                    <option value="inp">Dari Rawat Inap</option>
                                                    <option value="emd">Dari Rawat Darurat</option>
                                                    <option value="born">Lahir di RS</option>
                                                    <option value="nursing">Rujukan Panti Jompo</option>
                                                    <option value="psych">Rujukan dari RS Jiwa</option>
                                                    <option value="rehab">Rujukan Fasilitas Rehab</option>
                                                    <option value="other">Lain-lain</option>
                                                </select>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>Cara Pulang</td>
                                            <td colspan="3">
                                                <select name="discharge_status" id="ekdischarge_status" class="form-control">
                                                    <option value="1">Atas persetujuan dokter</option>
                                                    <option value="2">Dirujuk</option>
                                                    <option value="3">Atas permintaan sendiri</option>
                                                    <option value="4">Meninggal</option>
                                                    <option value="5">Lain-lain</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Coder NIK</td>
                                            <td colspan="3"><input onchange="eklaimInput(this)" type="text" name="coder_nik" id="ekcoder_nik" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>Tekanan Darah</td>
                                            <td>
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="ekaetension_upper" placeholder="" value="" class="form-control">
                                            </td>
                                            <td> / </td>
                                            <td>
                                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="ekaetension_below" placeholder="" value="" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <table class="table tablecustom table-bordered mb0">
                                    <tbody>
                                        <tr>
                                            <td>ADL Sub Acute</td>
                                            <td colspan="3"><input onchange="eklaimInput(this)" type="text" name="adl_sub_acute" id="ekadl_sub_acute" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>ADL Sub Chronic</td>
                                            <td colspan="3"><input onchange="eklaimInput(this)" type="text" name="adl_chronic" id="ekadl_chronic" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>Hemodialisa</td>
                                            <td colspan="3">
                                                <select name="dializer_single_use" id="ekdializer_single_use" class="form-control">
                                                    <option value="1">Single Use</option>
                                                    <option value="0">Multiple Use</option>
                                                </select>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Kantong Darah</td>
                                            <td colspan="3"><input onchange="eklaimInput(this)" type="text" name="kantong_darah" id="ekkantong_darah" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <table class="table tablecustom table-bordered mb0">
                                        <tbody>
                                            <tr>
                                                <td>Naik Kelas</td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" value="1" name="upgrade_class_ind" onclick="showHideEklaim('upgradeClassParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="upgrade_class_ind" onclick="showHideEklaim('upgradeClassParam',0)" checked>Tidak</label>
                                                </td>
                                                <td class="upgradeClassParam">=></td>
                                                <td class="upgradeClassParam">Menjadi Kelas</td>
                                                <td class="upgradeClassParam">
                                                    <select name="upgrade_class_class" id="ekupgrade_class_class" class="form-control">
                                                        <option value="kelas_1">Kelas 1</option>
                                                        <option value="kelas_2">Kelas 2</option>
                                                        <option value="vip">Kelas VIP</option>
                                                        <option value="vvip">Kelas VVIP</option>
                                                    </select>
                                                </td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr class="upgradeClassParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>LOS Naik Kelas</td>
                                                <td colspan=""><input onchange="eklaimInput(this)" type="text" name="upgrade_class_los" id="ekupgrade_class_los" placeholder="" value="" class="form-control"></td>
                                                <td>hari</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr class="upgradeClassParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Biaya Tambahan</td>
                                                <td colspan=""><input onchange="eklaimInput(this)" type="text" name="add_payment_pct" id="ekadd_payment_pct" placeholder="" value="" class="form-control"></td>
                                                <td>%</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr class="upgradeClassParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Penanggung</td>
                                                <td>
                                                    <select name="upgrade_class_payor" id="ekupgrade_class_payor" class="form-control">
                                                        <option value="peserta">Peserta</option>
                                                        <option value="pemberi_kerja">Pemberi Kerja</option>
                                                        <option value="asuransi_tambahan">Asuransi Tambahan</option>
                                                    </select>
                                                </td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr>
                                                <td>ICU</td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" value="1" name="icu_indikator" onclick="showHideEklaim('icuParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="icu_indikator" onclick="showHideEklaim('icuParam',0)" checked>Tidak</label>
                                                </td>
                                                <td class="icuParam">=></td>
                                                <td class="icuParam">LOS</td>
                                                <td class="icuParam"><input onchange="eklaimInput(this)" type="text" name="icu_los" id="ekicu_los" placeholder="" value="" class="form-control"></td>
                                                <td class="icuParam">hari</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr class="icuParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Ventilator</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="ventilator_hour" id="ekventilator_hour" placeholder="" value="" class="form-control"></td>
                                                <td>Jam</td>
                                                <td colspan="3"></td>
                                            </tr class="icuParam">
                                            <tr class="icuParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Uso Index</td>
                                                <td>
                                                    <select name="use_ind" id="ekuse_ind" class="form-control">
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="icuParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Tanggal Mulai</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="start_dttm" id="ekstart_dttm" placeholder="" value="" class="form-control"></td>
                                            </tr>
                                            <tr class="icuParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Tanggal Akhir</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="stop_dttm" id="ekstop_dttm" placeholder="" value="" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>APGAR</td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" value="1" name="apgar" onclick="showHideEklaim('apgarParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="apgar" onclick="showHideEklaim('apgarParam',0)" checked>Tidak</label>
                                                </td>
                                                <td class="apgarParam">=></td>
                                                <td class="apgarParam"></td>
                                                <td class="apgarParam">APR</td>
                                                <td class="apgarParam">PUL</td>
                                                <td class="apgarParam">GRI</td>
                                                <td class="apgarParam">ACTR</td>
                                                <td class="apgarParam">RES</td>
                                            </tr>

                                            <tr class="apgarParam">
                                                <td colspan="3"></td>
                                                <td>Menit 1</td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="appearance[]" id="ekmnt1appearance" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="pulse[]" id="ekmnt1pulse" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="grimace[]" id="ekmnt1grimace" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="activity[]" id="ekmnt1activity" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="respiration[]" id="ekmnt1respiration" placeholder="" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr class="apgarParam">
                                                <td colspan="3"></td>
                                                <td>Menit 5</td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="appearance[]" id="ekmnt5appearance" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="pulse[]" id="ekmnt5pulse" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="grimace[]" id="ekmnt5grimace" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="activity[]" id="ekmnt5activity" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input onchange="eklaimInput(this)" type="text" name="respiration[]" id="ekmnt5respiration" placeholder="" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Persalinan</td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" value="1" name="persalinan" onclick="showHideEklaim('persalinanParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="persalinan" onclick="showHideEklaim('persalinanParam',0)" checked>Tidak</label>
                                                </td>
                                                <td class="persalinanParam">=></td>
                                                <td class="persalinanParam">Usia Kehamilan</td>
                                                <td class="persalinanParam"><input onchange="eklaimInput(this)" type="text" name="usia_kehamilan" id="ekusia_kehamilan" placeholder="" value="" class="form-control"></td>
                                                <td class="persalinanParam">Minggu</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Onset Kontraksi</td>
                                                <td>
                                                    <select name="onset_kontraksi" id="ekonset_kontraksi" class="form-control">
                                                        <option value="spontan">Spontan</option>
                                                        <option value="induksi">Induksi</option>
                                                        <option value="non_spontan_non_induksi">Non Spontan Non Induksi</option>
                                                    </select>
                                                </td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Gravida</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="gravida" id="ekgravida" placeholder="" value="" class="form-control"></td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Partus</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="partus" id="ekpartus" placeholder="" value="" class="form-control"></td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td>=></td>
                                                <td>Abortus</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="abortus" id="ekabortus" placeholder="" value="" class="form-control"></td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td class="persalinanHead" style="width: 4%;">No</td>
                                                <td class="persalinanHead">Metode</td>
                                                <td class="persalinanHead">Waktu</td>
                                                <td class="persalinanHead">Letak Janin</td>
                                                <td class="persalinanHead">Kondisi</td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td class="persalinanBody persalinanBodyLeft"><input onchange="eklaimInput(this)" type="text" name="delivery_sequence[]" id="ekdelivery_sequence" placeholder="" value="" class="form-control"></td>
                                                <td class="persalinanBody">
                                                    <select name="delivery_method[]" id="ekdelivery_method" class="form-control">
                                                        <option value="vaginal">Vaginal</option>
                                                        <option value="sc">Sectio Caesarea</option>
                                                    </select>
                                                    <div>
                                                        <input type="checkbox" name="use_manual[]" id="ekuse_manual">
                                                        <label for="use_manual">Manual Aid</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="use_forcep[]" id="ekuse_forcep">
                                                        <label for="use_forcep">Forcep</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="use_vacuum[]" id="ekuse_vacuum">
                                                        <label for="use_vacuum">Vacuum</label>
                                                    </div>
                                                </td>
                                                <td class="persalinanBody persalinanBodyMiddle"><input onchange="eklaimInput(this)" type="text" name="delivery_dttm[]" id="ekdelivery_dttm" placeholder="" value="" class="form-control"></td>

                                                <td class="persalinanBody persalinanBodyMiddle">
                                                    <select name="letak_janin[]" id="ekletak_janin" class="form-control">
                                                        <option value="kepala">Kepala</option>
                                                        <option value="sungsang">Sungsang</option>
                                                        <option value="lintang">Lintang</option>
                                                    </select>
                                                </td>
                                                <td class="persalinanBody persalinanBodyright">
                                                    <select name="kondisi[]" id="ekkondisi" class="form-control">
                                                        <option value="livebirth">Live Birth</option>
                                                        <option value="stillbirth">Still Birth</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="persalinanParam">
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td>
                                                    <button type="button" id="ekformdiag" name="adddiagnosa" onclick="modalDiagnosa()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Tambah</span></button>

                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Covid-19</td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" value="1" name="covid_indicator" onclick="showHideEklaim('covidParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="covid_indicator" onclick="showHideEklaim('covidParam',0)" checked>Tidak</label>
                                                </td>
                                                <td class="covidParam">=></td>
                                                <td class="covidParam">Status CD</td>
                                                <td class="covidParam" colspan="2">
                                                    <select name="covid19_status_cd" id="ekcovid19_status_cd" class="form-control">
                                                        <option value="4">Suspek</option>
                                                        <option value="5">Probabel</option>
                                                        <option value="3">Terkonfirmasi Positif</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Nomor Klaim</td>
                                                <td colspan="2">
                                                    <input onchange="eklaimInput(this)" type="text" name="covid19_no_sep" id="ekcovid19_no_sep" placeholder="" value="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Nomor Kartu</td>
                                                <td colspan="2">
                                                    <select name="nomor_kartu_t" id="eknomor_kartu_t" class="form-control">
                                                        <option value="nik">NIK</option>
                                                        <option value="kitas">KITAS/KITAP</option>
                                                        <option value="paspor">Passport (WNA)</option>
                                                        <option value="kartu_jkn">No.Kartu BPJS</option>
                                                        <option value="kk">No.KK</option>
                                                        <option value="unhcr">UNHCR</option>
                                                        <option value="kelurahan">Kelurahan</option>
                                                        <option value="dinsos">Dinas Sosial</option>
                                                        <option value="dinkes">Dinas Kesehatan</option>
                                                        <option value="sjp">Surat Jaminan Perawatan (SJP)</option>
                                                        <option value="klaim_ibu">Ibu (Bayi baru lahir)</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Terapi Kovalensen</td>
                                                <td colspan="2">
                                                    <input onchange="eklaimInput(this)" type="text" name="terapi_konvalesen" id="ekterapi_konvalesen" placeholder="" value="" class="form-control">
                                                </td>
                                                <td>kantong</td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Isolasi Mandiri</td>
                                                <td colspan="2">
                                                    <select name="isoman_ind" id="ekisoman_ind" class="form-control">
                                                        <option value="1">Ya, melakukan isolasi mandiri</option>
                                                        <option value="0">Tidak melakukan isolasi mandiri</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Status Bayi Lahir</td>
                                                <td colspan="2">
                                                    <select name="bayi_lahir_status_cd" id="ekbayi_lahir_status_cd" class="form-control">
                                                        <option value="1">Tanpa Kelainan</option>
                                                        <option value="2">Dengan Kelainan</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>RS Darurat</td>
                                                <td colspan="2">
                                                    <select name="covid19_rs_darurat_ind" id="ekcovid19_rs_darurat_ind" class="form-control">
                                                        <option value="1">Ya, pasien dirawat di lokasi RS darurat atau RS lapangan</option>
                                                        <option value="0">Tidak dirawat di lokasi RS darurat atau RS lapangan</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Comorbidity/Complexity</td>
                                                <td colspan="2">
                                                    <select name="covid19_cc_ind" id="ekcovid19_cc_ind" class="form-control">
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Co-Insidense</td>
                                                <td colspan="2">
                                                    <select name="covid19_co_insidense_ind" id="ekcovid19_co_insidense_ind" class="form-control">
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td></td>
                                                <td>
                                                </td>
                                                <td>=></td>
                                                <td>Episodes</td>
                                                <td>1. ICU tekanan negatif dengan ventilator</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes7" id="ekepisodes7" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>2. ICU tekanan negatif tanpa ventilator</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes8" id="ekepisodes8" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>3. ICU tanpa tekanan negatif dengan ventilator</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes9" id="ekepisodes9" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>4. ICU tanpa tekanan negatif tanpa ventilator</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes10" id="ekepisodes10" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>5. Isolasi tekanan negatif</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes11" id="ekepisodes11" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>6. Isolasi tanpa tekanan negatif</td>
                                                <td><input onchange="eklaimInput(this)" type="text" name="episodes12" id="ekepisodes12" placeholder="" value="" class="form-control"></td>
                                                <td colspan="3">hari</td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="2"></td>
                                                <td>=></td>
                                                <td>Penunjang Pengurang</td>
                                                <td>
                                                    <input type="checkbox" name="lab_asam_laktat" id="eklab_asam_laktat" checked>
                                                    <label for="lab_asam_laktat">Lab. Asam Laktat</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_d_dimer" id="eklab_d_dimer" checked>
                                                    <label for="lab_d_dimer">Lab. D Dimer</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_anti_hiv" id="eklab_anti_hiv" checked>
                                                    <label for="lab_anti_hiv">Lab. Anti HIV</label>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="3"></td>
                                                <td>(centang jika tidak dilakukan)</td>
                                                <td>
                                                    <input type="checkbox" name="lab_procalcitonin" id="eklab_procalcitonin" checked>
                                                    <label for="lab_procalcitonin">Lab. Procalcitonin</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_pt" id="eklab_pt" checked>
                                                    <label for="lab_pt">Lab. PT</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_analisa_gas" id="eklab_analisa_gas" checked>
                                                    <label for="lab_analisa_gas">Lab. Analisa Gas</label>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>
                                                    <input type="checkbox" name="lab_crp" id="eklab_crp" checked>
                                                    <label for="lab_crp">Lab. CRP</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_aptt" id="eklab_aptt" checked>
                                                    <label for="lab_aptt">Lab. APTT</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_albumin" id="eklab_albumin" checked>
                                                    <label for="lab_albumin">Lab. Albumi</label>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>
                                                    <input type="checkbox" name="lab_kultur" id="eklab_kultur" checked>
                                                    <label for="lab_kultur">Lab. Kultur MO (aerob) dengan resistansi</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="lab_waktu_pendarahan" id="eklab_waktu_pendarahan" checked>
                                                    <label for="lab_waktu_pendarahan">Lab. Waktu Pendarahan</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="rad_thorax_ap_pa" id="ekrad_thorax_ap_pa" checked>
                                                    <label for="rad_thorax_ap_pa">Radiologi Thorax AP / PA</label>
                                                </td>
                                            </tr>

                                            <tr class="covidParam">
                                                <td colspan="2"></td>
                                                <td>=></td>
                                                <td>Meninggal Dunia</td>
                                                <td>
                                                    <input type="checkbox" name="pemulasaraan_jenazah" id="ekpemulasaraan_jenazah">
                                                    <label for="pemulasaraan_jenazah">Pemulasaran Jenazah</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="kantong_jenazah" id="ekkantong_jenazah">
                                                    <label for="kantong_jenazah">Kantong Jenazah</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="peti_jenazah" id="ekpeti_jenazah">
                                                    <label for="peti_jenazah">Peti Jenazah</label>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>
                                                    <input type="checkbox" name="plastik_erat" id="ekplastik_erat">
                                                    <label for="plastik_erat">Plastik Erat</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="desinfektan_jenazah" id="ekdesinfektan_jenazah">
                                                    <label for="desinfektan_jenazah">Disinfektan Jenazah</label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="mobil_jenazah" id="ekmobil_jenazah">
                                                    <label for="mobil_jenazah">Mobil Jenazah</label>
                                                </td>
                                            </tr>
                                            <tr class="covidParam">
                                                <td colspan="4"></td>
                                                <td>
                                                    <input type="checkbox" name="desinfektan_mobil_jenazah" id="ekdesinfektan_mobil_jenazah">
                                                    <label for="desinfektan_mobil_jenazah">Disinfektan Mobil Jenazah</label>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <div class="col-sm-12 col-md-12 col-lg-12">

                                    </div>
                                </div>

                            </div><!--./col-lg-12-->
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <h3>

                                </h3>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Tarif Rumah Sakit</h3>
                                <table class="table tablecustom table-borderedcustom mb0">
                                    <tbody>
                                        <tr>
                                            <td colspan="6" style="text-align:center;border-top:0;"><span style="font-style:italic;color:#888;">Tarif Rumah Sakit :</span>&nbsp;<span style="font-size:1.11em;color:#888;">Rp</span>
                                                <input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="billing_amount" id="ekbilling_amount" onkeydown="kp_chg_billing(this,event);">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Prosedur Non Bedah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="prosedur_non_bedah" id="ekprosedur_non_bedah" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Prosedur Non Bedah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="prosedur_bedah" id="ekprosedur_bedah" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Konsultasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="konsultasi" id="ekkonsultasi" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Tenaga Ahli</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="tenaga_ahli" id="ektenaga_ahli" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Keperawatan</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="keperawatan" id="ekkeperawatan" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Penunjang</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="penunjang" id="ekpenunjang" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Radiologi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="radiologi" id="ekradiologi" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Laboratorium</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="laboratorium" id="eklaboratorium" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Pelayanan Darah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="pelayanan_darah" id="ekpelayanan_darah" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Rehabilitasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="rehabilitasi" id="ekrehabilitasi" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Kamar / Akomodasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="kamar" id="ekkamar" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">KamRawat Intensif</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="rawat_intensif" id="ekrawat_intensif" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Obat</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="obat" id="ekobat" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Obat Kronis</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="obat_kronis" id="ekobat_kronis" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Obat Kemoterapi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="obat_kemoterapi" id="ekobat_kemoterapi" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Alkes</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="alkes" id="ekalkes" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">BMHP</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="bmhp" id="ekbmhp" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Sewa Alat</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:center;width:8em;" value="0" name="sewa_alat" id="eksewa_alat" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- col-sm-12 col-md-12 col-lg-12 -->
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <h3>Coding UNU Grouper</h3>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th>Diagnosa (ICD X)</th>
                                                    <th>Kategori Diagnosis</th>
                                                </thead>
                                                <tbody id="ekbodyDiagUnu">

                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="ekunuDiagAdd" onclick="addUnuDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Diagnosa UNU</span></button>
                                    </div>

                                </div>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th>Prosedur (ICD IX)</th>
                                                </thead>
                                                <tbody id="ekbodyProcUnu">

                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="ekunuProcAdd" onclick="addUnuProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Prosedur UNU</span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <h3>Coding INA Grouper</h3>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th>Diagnosa (ICD X)</th>
                                                    <th>Kategori Diagnosis</th>
                                                </thead>
                                                <tbody id="ekbodyDiagIna">

                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="ekinaDiagAdd" onclick="addInaDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Diagnosa INA</span></button>
                                    </div>

                                </div>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                            <?php if (true) { ?>
                                                <thead>
                                                    <th>Prosedur (ICD IX)</th>
                                                </thead>
                                                <tbody id="ekbodyProcIna">

                                                </tbody>
                                            <?php }   ?>
                                        </table>
                                    </div>
                                    <div class="box-tab-tools" style="text-align: center;">
                                        <button type="button" id="ekinaProcAdd" onclick="addInaProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info"><i class="fa fa-plus"></i> <span>Prosedur INA</span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>
                                    Hasil Grouper E-Klaim v5
                                </h3>
                                <table class="table table-borderedcustom table-hover" style="width:100%;">
                                    <colgroup>
                                        <col width="190">
                                        <col>
                                        <col width="70">
                                        <col width="127">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th colspan="4" style="text-align:center;" class="hdr_grouper_result grouper_result_final">Hasil Grouper E-Klaim v5 - Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td>Info</td>
                                            <td colspan="3">Heri Susilo @ 7 Agu 2023 11:44 •• Kelas B •• Tarif : TARIF RS KELAS B PEMERINTAH</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Rawat</td>
                                            <td>Rawat Inap Kelas 1 (3 Hari)</td>
                                            <td style="border-left:0px;">&nbsp;</td>
                                            <td style="border-left:0;text-align:right;">&nbsp;</td>
                                        </tr> -->
                                        <tr>
                                            <td>Group</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td id="cbgdescription"></td>
                                                            <td id="cbgcode"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="cbgtariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Acute</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td id="sub_acutedescription">-</td>
                                                            <td id="sub_acutecode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="sub_acutetariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Chronic</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td id="chronicdescription">-</td>
                                                            <td id="chroniccode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="chronictariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Special Procedure</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td><select name="special_procedure" id="special_proceduredescription" class="form-control" style="width: 50%;" disabled>
                                                                    <option value="">-</option>
                                                                </select></td>
                                                            <td id="special_procedurecode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="special_proceduretariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Special Prosthesis</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td><select name="special_prosthesis" id="special_prosthesisdescription" class="form-control" style="width: 50%;" disabled>
                                                                    <option value="">-</option>
                                                                </select></td>
                                                            <td id="special_prosthesiscode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="special_prosthesistariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Special Investigation</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td><select name="special_investigation" id="special_investigationdescription" class="form-control" style="width: 50%;" disabled>
                                                                    <option value="">-</option>
                                                                </select></td>
                                                            <td id="special_investigationcode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="special_investigationtariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Special Drug</td>
                                            <td>
                                                <table class="" style="width:100%;">
                                                    <colgroup>
                                                        <col>
                                                        <col width="100">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td><select name="special_drug" id="special_drugdescription" class="form-control" style="width: 50%;" disabled>
                                                                    <option value="">-</option>
                                                                </select></td>
                                                            <td id="special_drugcode">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="border-left:0px;">&nbsp;Rp</td>
                                            <td id="special_drugtariff" style="border-left:0;text-align:right;">0</td>
                                        </tr>
                                        <tr>
                                            <td>Status DC Kemkes</td>
                                            <td id="ektd_dc_status"></td>
                                            <td style="border-left:0px;">&nbsp;</td>
                                            <td style="border-left:0;text-align:right;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:top;">Status Klaim</td>
                                            <td id="ektd_klaim_status" style="vertical-align:top;"></td>
                                            <td colspan="2" style="border-left:0;text-align:right;vertical-align:top;">&nbsp;&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;">[ <span class="xlnk" onclick="$(&quot;#trdebug&quot;).fadeToggle();">debug</span> ]</td>
                                            <td style="border-left:0;font-weight:bold;text-align:right;" colspan="2">Total Rp</td>
                                            <td id="totalGrouper" style="border-left:0;font-weight:bold;text-align:right;">0</td>
                                        </tr>
                                        <tr id="ektrdebug" style="display:none;">
                                            <td colspan="4" style="border-top:0;text-align:left;color:#eee;font-family:Courier New;">
                                                <div style="background-color:#000;border-radius:0.5em;padding:1em;">
                                                    <table class="invisible">
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align:left;">input&nbsp;</td>
                                                                <td>: 1 30/07/2023 01/08/2023 24/06/2012 0 1 1 S31.3 62.5;99.29;99.21;90.59 - - None None None None</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;">response&nbsp;</td>
                                                                <td>: V-1-12-I;None;None;None;None;None;None</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--./row-->
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="examination_date">Tgl Periksa</label>
                                <input type='text' name="examination_date" class="form-control" id='examination_date' />
                            </div>

                        </div> -->
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="ekaepetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" id="ekfinalklaimbtn" onclick="finalKlaim()" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info">Final Klaim</button>
                        <button type="submit" id="ekformsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="ekeditbtn" onclick="editKlaim()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->


<script type="text/javascript">
    function showHideEklaim(param, showhide) {
        if (showhide == 1) {
            $("." + param).show()
        } else if (showhide == 0) {
            $("." + param).hide()
        }
    }
    $(".upgradeClassParam").hide()
    $(".icuParam").hide()
    $(".apgarParam").hide()
    $(".persalinanParam").hide()
    $(".covidParam").hide()
    var iUnuDiag = 0;
    var iUnuProc = 0;
    var iInaDiag = 0;
    var iInaProc = 0;
    var currentStep = 0;
    var ekklaim_final = 0;

    var eklaimCaraKeluar = [];
    eklaimCaraKeluar[0] = 5;
    eklaimCaraKeluar[1] = 1;
    eklaimCaraKeluar[2] = 2;
    eklaimCaraKeluar[3] = 4;
    eklaimCaraKeluar[4] = 4;
    eklaimCaraKeluar[5] = 3;
    eklaimCaraKeluar[6] = 5;
    eklaimCaraKeluar[7] = 1;
    eklaimCaraKeluar[32] = 5;
    eklaimCaraKeluar[33] = 5;
    eklaimCaraKeluar[35] = 5;
    eklaimCaraKeluar[36] = 5;

    var ektrans_id = '<?= $visit['trans_id']; ?>'
    var ekvisit_id = '<?= $visit['visit_id']; ?>'
    var eknosep = '<?= $visit['no_skp']; ?>'
    var eknosep_inap = '<?= $visit['no_skpinap']; ?>'
    var eknomor_kartu = '<?= $visit['pasien_id']; ?>'
    var eknomor_sep = '<?= $visit['no_skpinap'] ?? $visit['no_skp']; ?>'
    var eknomor_rm = '<?= $visit['no_registration']; ?>'
    var eknama_pasien = '<?= $visit['diantar_oleh']; ?>'
    var ekgender = '<?= $visit['gender']; ?>'
    var ektgl_lahir = ''
    var ekpayor_id = '3'
    var ekpayor_cd = 'JKN'
    var ekcob_cd = '-'

    var ekjenis_rawat = '<?= !isset($visit['no_skpinap']) || is_null($visit['no_skpinap']) ? 2 : 1; ?>'
    var ektgl_masuk = '<?= $visit['visit_date']; ?>'
    var ektgl_pulang = '<?= $visit['no_skpinap'] == '' || is_null($visit['no_skpinap']) ? $visit['visit_date'] : $visit['exit_date']; ?>'
    var ekcara_masuk = '<?php if ($visit['asalrujukan'] == '1') {
                            echo 'gp';
                        } else if ($visit['asalrujukan'] == '2') {
                            echo 'hosp-trans';
                        } ?>'
    var ekdischarge_status = eklaimCaraKeluar['<?= $visit['keluar_id']; ?>']
    <?php $empl = user()->getEmployeeData() ?>
    var ekcoder_nik = '1771051804810003' //'<?= isset($empl['npk']) ? $empl['npk'] : ''; ?>'
    var eknama_dokter = '<?= is_null($visit['fullname_inap']) || $visit['fullname_inap'] == '' ? $visit['fullname'] : $visit['fullname_inap']; ?>'
    var ektarif_poli_eks = 10000
    var ekkode_tarif = 'BP'
    var ektension_upper = $("#aetension_upper").val()
    var ektension_below = $("#aetension_below").val()
    var ekadl_sub_acute = ''
    var ekadl_chronic = ''
    var ekdializer_single_use = ''
    var ekkantong_darah = ''
    var ekkelas_rawat = '<?= is_null($visit['class_room_id']) ? ($visit['kdpoli_eks'] == '0' ? '3' : '1') : ($visit['class_id_plafond'] - 1); ?>'
    var ekbirth_weight = 0;

    var ekupgrade_class_ind = '<?=
                                (in_array($visit['class_id_plafond'], ['2', '3'])
                                    && in_array(($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id']), ['3', '4'])
                                    && ($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id']) > $visit['class_id_plafond'] ? $visit['class_id_plafond'] : ($visit['class_id'] == '10' ? $visit['class_id_plafond'] : $visit['class_id'])
                                ) != $visit['class_id_plafond'] ? '1' : '0'
                                ?>'
    var ekupgrade_class_class = '<?php switch ($visit['class_id']) {
                                        case '3':
                                            echo 'kelas_2';
                                            break;
                                        case '2':
                                            echo 'kelas_1';
                                            break;
                                        case '6':
                                            echo 'vip';
                                            break;
                                        case '11':
                                            echo 'vip';
                                            break;
                                    } ?>'
    var ekupgrade_class_los = ''
    var ekadd_payment_pct = '75'
    var ekupgrade_class_payor = ''

    var ekicu_indikator = ''
    var ekicu_los = ''
    var ekventilator_hour = ''
    var ekuse_ind = ''
    var ekstart_dttm = ''
    var ekstop_dttm = ''

    var ekapgar = ''
    var ekappearance = ''
    var ekpulse = ''
    var ekgrimace = ''
    var ekactivity = ''
    var ekrespiration = ''

    var ekpersalinan = ''
    var ekusia_kehamilan = ''
    var ekonset_kontraksi = ''
    var ekgravida = ''
    var ekpartus = ''
    var ekabortus = ''
    var ekdelivery_method = ''
    var ekuse_manual = ''
    var ekuse_forcep = ''
    var ekuse_vacuum = ''
    var ekletak_janin = ''
    var ekkondisi = ''

    var ekcovid_indicator = ''
    var ekcovid19_status_cd = ''
    var ekcovid19_no_sep = ''
    var eknomor_kartu_t = ''
    var ekterapi_konvalesen = ''
    var ekisoman_ind = ''
    var ekbayi_lahir_status_cd = ''
    var ekcovid19_rs_darurat_ind = ''
    var ekcovid19_cc_ind = ''
    var ekcovid19_co_insidense_ind = ''
    var ekepisodes7 = ''
    var ekepisodes8 = ''
    var ekepisodes9 = ''
    var ekepisodes10 = ''
    var ekepisodes11 = ''
    var ekepisodes12 = ''
    var eklab_asam_laktat = ''
    var eklab_d_dimer = ''
    var eklab_anti_hiv = ''
    var eklab_procalcitonin = ''
    var eklab_analisa_gas = ''
    var eklab_crp = ''
    var eklab_pt = '';
    var eklab_aptt = ''
    var eklab_albumin = ''
    var eklab_kultur = ''
    var eklab_waktu_pendarahan = ''
    var ekrad_thorax_ap_pa = ''
    var ekpemulasaraan_jenazah = ''
    var ekkantong_jenazah = ''
    var ekpeti_jenazah = ''
    var ekplastik_erat = ''
    var ekdesinfektan_jenazah = ''
    var ekmobil_jenazah = ''
    var ekdesinfektan_mobil_jenazah = ''

    var ekprosedur_non_bedah = 0.0;
    var ekprosedur_bedah = 0.0;
    var ekkonsultasi = 0.0;
    var ektenaga_ahli = 0.0;
    var ekkeperawatan = 0.0;
    var ekpenunjang = 0.0;
    var ekradiologi = 0.0;
    var eklaboratorium = 0.0;
    var ekpelayanan_darah = 0.0;
    var ekrehabilitasi = 0.0;
    var ekkamar = 0.0;
    var ekrawat_intensif = 0.0;
    var eksewa_alat = 0.0;
    var ekobat = 0.0;
    var ekobat_kronis = 0.0;
    var ekobat_kemoterapi = 0.0;
    var ekalkes = 0.0;
    var ekbmhp = 0.0;
    var ektotalBillEklaim = 0.0;
</script>

<script type="text/javascript">
    $(document).ready(function(e) {
        setEklaimData()
        // var trans = '<?= $visit['trans_id']; ?>'
        // getBillEklaim18(trans)

        getEklaimData(eknomor_sep)
    })

    function addUnuDiag(initialvalue = null, initialname = null, initialcat = null) {
        iUnuDiag++;
        $("#ekbodyDiagUnu")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekunuDiag' + iUnuDiag + '" class="form-control" name="unuDiag[]" ></select></div>')
                )
                .append($('<td>')
                    .append($('<select class="form-control">')
                        .attr('name', 'unuDiagCat[]').attr('id', 'unuDiagCat' + iUnuDiag) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                    )
                )
            )

        initializeDiagSelect2("ekunuDiag" + iUnuDiag, initialvalue, initialname)
        $("#unuDiagCat" + iUnuDiag).val(initialcat);
    }

    function addUnuProc(initialvalue = null, initialname = null, initialcat = null) {
        iUnuProc++;
        $("#ekbodyProcUnu")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekunuProc' + iUnuProc + '" class="form-control" name="unuProc[]" ></select></div>')
                )
            )

        initializeProcSelect2("ekunuProc" + iUnuProc, initialvalue, initialname)
    }

    function addInaDiag(initialvalue = null, initialname = null, initialcat = null) {
        iInaDiag++;
        $("#ekbodyDiagIna")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekinaDiag' + iInaDiag + '" class="form-control" name="inaDiag[]" ></select></div>')
                )
                .append($('<td>')
                    .append($('<select class="form-control">')
                        .attr('name', 'inaDiagCat[]').attr('id', 'inaDiagCat' + iInaDiag) <?php foreach ($diagCat as $key => $value) { ?>
                            .append($("<option>")
                                .attr('value', '<?= $diagCat[$key]['diag_cat']; ?>').html('<?= $diagCat[$key]['diagnosa_category']; ?>')
                            ) <?php } ?>
                    )
                )
            )

        initializeDiagSelect2("ekinaDiag" + iInaDiag, initialvalue, initialname)
        $("#inaDiagCat" + iInaDiag).val(initialcat);
    }

    function addInaProc(initialvalue = null, initialname = null, initialcat = null) {
        iInaProc++;
        $("#ekbodyProcIna")
            .append($("<tr>")
                .append($("<td>")
                    .append('<div class="p-2 select2-full-width"><select id="ekinaProc' + iInaProc + '" class="form-control" name="inaProc[]" ></select></div>')
                )
            )

        initializeProcSelect2("ekinaProc" + iInaProc, initialvalue, initialname)
    }

    function setEklaimData() {
        if (currentStep < 3) {
            $("#ekfinalklaimbtn").hide()
        } else {
            $("#ekfinalklaimbtn").show()
        }

        $("#ekcurrentStep").val(currentStep)
        $("#ektrans_id").val(ektrans_id)
        $("#ekvisit_id").val(ekvisit_id)
        $("#eknosep").val(eknosep)
        $("#eknosep_inap").val(eknosep_inap)
        $("#eknama_pasien").val(eknama_pasien)
        $("#ekgender").val(ekgender)
        $("#eknomor_rm").val(eknomor_rm)
        $("#ektgl_lahir").val(ektgl_lahir)
        $("#eknama_dokter").val(eknama_dokter)


        $("#eknomor_kartu").val(eknomor_kartu)
        $("#eknomor_sep").val(eknomor_sep)
        $("#ekpayor_id").val(ekpayor_id)
        $("#ekpayor_cd").val(ekpayor_cd)
        $("#payor").val(ekpayor_id + '-' + ekpayor_cd)
        $("#ekcob_cd").val(ekcob_cd)
        $("#ekkode_tarif").val(ekkode_tarif)

        $("#ekjenis_rawat").val(ekjenis_rawat)
        $("#ekkelas_rawat").val(ekkelas_rawat)
        $("#ektgl_masuk").val(ektgl_masuk)
        $("#ektgl_pulang").val(ektgl_pulang)
        $("#ekcara_masuk").val(ekcara_masuk)
        $("#ekdischarge_status").val(ekdischarge_status)
        $("#ekcoder_nik").val(ekcoder_nik)
        $("#ektension_upper").val(ektension_upper)
        $("#ektension_below").val(ektension_below)
        $("#ekadl_sub_acute").val(ekadl_sub_acute)
        $("#ekadl_chronic").val(ekadl_chronic)
        $("#ekdializer_single_use").val(ekdializer_single_use)
        $("#ekkantong_darah").val(ekkantong_darah)
        $("input[name=upgrade_class_ind][value=" + ekupgrade_class_ind + "]").prop('checked', true);
        if (ekupgrade_class_ind == '1') {
            $(".upgradeClassParam").show()
        } else {
            $(".upgradeClassParam").hide()
        }
        $("#ekupgrade_class_class").val(ekupgrade_class_class)
        $("#ekupgrade_class_los").val(ekupgrade_class_los)
        $("#ekadd_payment_pct").val(ekadd_payment_pct)
        $("#ekupgrade_class_payor").val(ekupgrade_class_payor)

        $("#ekicu_indikator").val(ekicu_indikator)
        $("#ekicu_los").val(ekicu_los)
        $("#ekventilator_hour").val(ekventilator_hour)
        $("#ekuse_ind").val(ekuse_ind)
        $("#ekstart_dttm").val(ekstart_dttm)
        $("#ekstop_dttm").val(ekstop_dttm)
        $("#ekbirth_weight").val(ekbirth_weight)

        // $("input[name=apgar][value=" + ekapgar + "]").prop('checked', true);
        // $("#ekmnt1appearance").val(ekapgar[0].appearance)
        // $("#ekmnt1pulse").val(ekapgar[0].pulse)
        // $("#ekmnt1grimace").val(ekapgar[0].grimace)
        // $("#ekmnt1activity").val(ekapgar[0].activity)
        // $("#ekmnt1respiration").val(ekapgar[0].respiration)
        // $("#ekmnt5appearance").val(ekapgar[1].appearance)
        // $("#ekmnt5pulse").val(ekapgar[1].pulse)
        // $("#ekmnt5grimace").val(ekapgar[1].grimace)
        // $("#ekmnt5activity").val(ekapgar[1].activity)
        // $("#ekmnt5respiration").val(ekapgar[1].respiration)

        // $("input[name=persalinan][value=" + ekpersalinan + "]").prop('checked', true);
        $("#ekusia_kehamilan").val(ekusia_kehamilan)
        $("#ekonset_kontraksi").val(ekonset_kontraksi)
        $("#ekgravida").val(ekgravida)
        $("#ekpartus").val(ekpartus)
        $("#ekabortus").val(ekabortus)
        $("#ekdelivery_sequence").val('')
        $("#ekdelivery_method").val('')
        $("#ekuse_manual").val('')
        $("#ekuse_forcep").val('')
        $("#ekuse_vacuum").val('')
        $("#ekletak_janin").val('')
        $("#ekkondisi").val('')

        $('#ektarif_poli_eks').val(ektarif_poli_eks)

        // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
        $("#ekcovid19_status_cd").val(ekcovid19_status_cd)
        $("#eknomor_kartu_t").val(eknomor_kartu_t)
        $("#ekcovid19_no_sep").val(ekcovid19_no_sep)
        $("#ekterapi_konvalesen").val(ekterapi_konvalesen)
        $("#ekisoman_ind").val(ekisoman_ind)
        $("#ekbayi_lahir_status_cd").val(ekbayi_lahir_status_cd)
        $("#ekcovid19_rs_darurat_ind").val(ekcovid19_rs_darurat_ind)
        $("#ekcovid19_cc_ind").val(ekcovid19_cc_ind)
        $("#ekcovid19_co_insidense_ind").val(ekcovid19_co_insidense_ind)
        $("#ekepisodes7").val(ekepisodes7)
        $("#ekepisodes8").val(ekepisodes8)
        $("#ekepisodes9").val(ekepisodes9)
        $("#ekepisodes10").val(ekepisodes10)
        $("#ekepisodes11").val(ekepisodes11)
        $("#ekepisodes12").val(ekepisodes12)
        $("#eklab_asam_laktat").val(eklab_asam_laktat)
        $("#eklab_d_dimer").val(eklab_d_dimer)
        $("#eklab_anti_hiv").val(eklab_anti_hiv)
        $("#eklab_procalcitonin").val(eklab_procalcitonin)
        $("#eklab_analisa_gas").val(eklab_analisa_gas)
        $("#eklab_crp").val(eklab_crp)
        $("#eklab_aptt").val(eklab_aptt)
        $("#eklab_pt").val(eklab_pt)
        $("#eklab_albumin").val(eklab_albumin)
        $("#eklab_kultur").val(eklab_kultur)
        $("#eklab_waktu_pendarahan").val(eklab_waktu_pendarahan)
        $("#ekrad_thorax_ap_pa").val(ekrad_thorax_ap_pa)
        $("#ekpemulasaraan_jenazah").val(ekpemulasaraan_jenazah)
        $("#ekkantong_jenazah").val(ekkantong_jenazah)
        $("#ekpeti_jenazah").val(ekpeti_jenazah)
        $("#ekplastik_erat").val(ekplastik_erat)
        $("#ekdesinfektan_jenazah").val(ekdesinfektan_jenazah)
        $("#ekmobil_jenazah").val(ekmobil_jenazah)
        $("#ekdesinfektan_mobil_jenazah").val(ekdesinfektan_mobil_jenazah)

        $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
        $("#ekprosedur_bedah").val((ekprosedur_bedah))
        $("#ekkonsultasi").val((ekkonsultasi))
        $("#ektenaga_ahli").val((ektenaga_ahli))
        $("#ekkeperawatan").val((ekkeperawatan))
        $("#ekpenunjang").val((ekpenunjang))
        $("#ekradiologi").val((ekradiologi))
        $("#eklaboratorium").val((eklaboratorium))
        $("#ekpelayanan_darah").val((ekpelayanan_darah))
        $("#ekrehabilitasi").val((ekrehabilitasi))
        $("#ekkamar").val((ekkamar))
        $("#ekrawat_intensif").val((ekrawat_intensif))
        $("#ekobat").val((ekobat))
        $("#ekobat_kronis").val((ekobat_kronis))
        $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
        $("#ekalkes").val((ekalkes))
        $("#ekbmhp").val((ekbmhp))
        $("#eksewa_alat").val((eksewa_alat))
        $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))


    }

    function setEklaimData() {

        $("#ekcurrentStep").val(currentStep)
        $("#ektrans_id").val(ektrans_id)
        $("#ekvisit_id").val(ekvisit_id)
        $("#eknosep").val(eknosep)
        $("#eknosep_inap").val(eknosep_inap)
        $("#eknama_pasien").val(eknama_pasien)
        $("#ekgender").val(ekgender)
        $("#eknomor_rm").val(eknomor_rm)
        $("#ektgl_lahir").val(ektgl_lahir)
        $("#eknama_dokter").val(eknama_dokter)


        $("#eknomor_kartu").val(eknomor_kartu)
        $("#eknomor_sep").val(eknomor_sep)
        $("#ekpayor_id").val(ekpayor_id)
        $("#ekpayor_cd").val(ekpayor_cd)
        $("#payor").val(ekpayor_id + '-' + ekpayor_cd)
        $("#ekcob_cd").val(ekcob_cd)
        $("#ekkode_tarif").val(ekkode_tarif)

        $("#ekjenis_rawat").val(ekjenis_rawat)
        $("#ekkelas_rawat").val(ekkelas_rawat)
        $("#ektgl_masuk").val(ektgl_masuk)
        $("#ektgl_pulang").val(ektgl_pulang)
        $("#ekcara_masuk").val(ekcara_masuk)
        $("#ekdischarge_status").val(ekdischarge_status)
        $("#ekcoder_nik").val(ekcoder_nik)
        $("#ektension_upper").val(ektension_upper)
        $("#ektension_below").val(ektension_below)
        $("#ekadl_sub_acute").val(ekadl_sub_acute)
        $("#ekadl_chronic").val(ekadl_chronic)
        $("#ekdializer_single_use").val(ekdializer_single_use)
        $("#ekkantong_darah").val(ekkantong_darah)
        $("input[name=upgrade_class_ind][value=" + ekupgrade_class_ind + "]").prop('checked', true);
        if (ekupgrade_class_ind == '1') {
            $(".upgradeClassParam").show()
        } else {
            $(".upgradeClassParam").hide()
        }
        $("#ekupgrade_class_class").val(ekupgrade_class_class)
        $("#ekupgrade_class_los").val(ekupgrade_class_los)
        $("#ekadd_payment_pct").val(ekadd_payment_pct)
        $("#ekupgrade_class_payor").val(ekupgrade_class_payor)

        $("#ekicu_indikator").val(ekicu_indikator)
        $("#ekicu_los").val(ekicu_los)
        $("#ekventilator_hour").val(ekventilator_hour)
        $("#ekuse_ind").val(ekuse_ind)
        $("#ekstart_dttm").val(ekstart_dttm)
        $("#ekstop_dttm").val(ekstop_dttm)
        $("#ekbirth_weight").val(ekbirth_weight)

        // $("input[name=apgar][value=" + ekapgar + "]").prop('checked', true);
        // $("#ekmnt1appearance").val(ekapgar[0].appearance)
        // $("#ekmnt1pulse").val(ekapgar[0].pulse)
        // $("#ekmnt1grimace").val(ekapgar[0].grimace)
        // $("#ekmnt1activity").val(ekapgar[0].activity)
        // $("#ekmnt1respiration").val(ekapgar[0].respiration)
        // $("#ekmnt5appearance").val(ekapgar[1].appearance)
        // $("#ekmnt5pulse").val(ekapgar[1].pulse)
        // $("#ekmnt5grimace").val(ekapgar[1].grimace)
        // $("#ekmnt5activity").val(ekapgar[1].activity)
        // $("#ekmnt5respiration").val(ekapgar[1].respiration)

        // $("input[name=persalinan][value=" + ekpersalinan + "]").prop('checked', true);
        $("#ekusia_kehamilan").val(ekusia_kehamilan)
        $("#ekonset_kontraksi").val(ekonset_kontraksi)
        $("#ekgravida").val(ekgravida)
        $("#ekpartus").val(ekpartus)
        $("#ekabortus").val(ekabortus)
        $("#ekdelivery_sequence").val('')
        $("#ekdelivery_method").val('')
        $("#ekuse_manual").val('')
        $("#ekuse_forcep").val('')
        $("#ekuse_vacuum").val('')
        $("#ekletak_janin").val('')
        $("#ekkondisi").val('')

        $('#ektarif_poli_eks').val(ektarif_poli_eks)

        // $("input[name=covid_indicator][value=" + ekcovid_indicator + "]").prop('checked', true);
        $("#ekcovid19_status_cd").val(ekcovid19_status_cd)
        $("#eknomor_kartu_t").val(eknomor_kartu_t)
        $("#ekcovid19_no_sep").val(ekcovid19_no_sep)
        $("#ekterapi_konvalesen").val(ekterapi_konvalesen)
        $("#ekisoman_ind").val(ekisoman_ind)
        $("#ekbayi_lahir_status_cd").val(ekbayi_lahir_status_cd)
        $("#ekcovid19_rs_darurat_ind").val(ekcovid19_rs_darurat_ind)
        $("#ekcovid19_cc_ind").val(ekcovid19_cc_ind)
        $("#ekcovid19_co_insidense_ind").val(ekcovid19_co_insidense_ind)
        $("#ekepisodes7").val(ekepisodes7)
        $("#ekepisodes8").val(ekepisodes8)
        $("#ekepisodes9").val(ekepisodes9)
        $("#ekepisodes10").val(ekepisodes10)
        $("#ekepisodes11").val(ekepisodes11)
        $("#ekepisodes12").val(ekepisodes12)
        $("#eklab_asam_laktat").val(eklab_asam_laktat)
        $("#eklab_d_dimer").val(eklab_d_dimer)
        $("#eklab_anti_hiv").val(eklab_anti_hiv)
        $("#eklab_procalcitonin").val(eklab_procalcitonin)
        $("#eklab_analisa_gas").val(eklab_analisa_gas)
        $("#eklab_crp").val(eklab_crp)
        $("#eklab_aptt").val(eklab_aptt)
        $("#eklab_pt").val(eklab_pt)
        $("#eklab_albumin").val(eklab_albumin)
        $("#eklab_kultur").val(eklab_kultur)
        $("#eklab_waktu_pendarahan").val(eklab_waktu_pendarahan)
        $("#ekrad_thorax_ap_pa").val(ekrad_thorax_ap_pa)
        $("#ekpemulasaraan_jenazah").val(ekpemulasaraan_jenazah)
        $("#ekkantong_jenazah").val(ekkantong_jenazah)
        $("#ekpeti_jenazah").val(ekpeti_jenazah)
        $("#ekplastik_erat").val(ekplastik_erat)
        $("#ekdesinfektan_jenazah").val(ekdesinfektan_jenazah)
        $("#ekmobil_jenazah").val(ekmobil_jenazah)
        $("#ekdesinfektan_mobil_jenazah").val(ekdesinfektan_mobil_jenazah)

        $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
        $("#ekprosedur_bedah").val((ekprosedur_bedah))
        $("#ekkonsultasi").val((ekkonsultasi))
        $("#ektenaga_ahli").val((ektenaga_ahli))
        $("#ekkeperawatan").val((ekkeperawatan))
        $("#ekpenunjang").val((ekpenunjang))
        $("#ekradiologi").val((ekradiologi))
        $("#eklaboratorium").val((eklaboratorium))
        $("#ekpelayanan_darah").val((ekpelayanan_darah))
        $("#ekrehabilitasi").val((ekrehabilitasi))
        $("#ekkamar").val((ekkamar))
        $("#ekrawat_intensif").val((ekrawat_intensif))
        $("#ekobat").val((ekobat))
        $("#ekobat_kronis").val((ekobat_kronis))
        $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
        $("#ekalkes").val((ekalkes))
        $("#ekbmhp").val((ekbmhp))
        $("#eksewa_alat").val((eksewa_alat))
        $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))


    }

    function setEnableEklaim(bool) {

        $('#formeklaim input').attr('disabled', bool);
        $('#formeklaim textarea').attr('disabled', bool);
        $('#formeklaim select').attr('disabled', bool);


    }

    var grouperResp;

    function getEklaimData(nosep_klaim) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getEklaimData',
            type: "POST",
            data: JSON.stringify({
                'nosep_klaim': nosep_klaim
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.nosep_klaim != '' && typeof data.nosep_klaim !== 'undefined') {
                    ekklaim_final = data.klaim_status
                    eknosep = data.nosep
                    eknosep_inap = data.nosep_inap
                    eknomor_kartu = data.nokartu
                    eknomor_sep = data.nosep_klaim
                    eknomor_rm = data.nomr
                    eknama_pasien = data.namapasien
                    ekgender = data.gender
                    ektgl_lahir = data.tgllahir
                    ekpayor_id = data.payor_id
                    ekpayor_cd = data.payor_cd
                    ekcob_cd = data.cob_cd

                    ekjenis_rawat = data.jnsrawat
                    ektgl_masuk = (data.tgl_masuk)
                    ektgl_masuk = ektgl_masuk.substring(0, 16)
                    ektgl_pulang = data.tgl_keluar
                    ektgl_pulang = ektgl_pulang.substring(0, 16)
                    ekcara_masuk = data.cara_masuk
                    ekdischarge_status = eklaimCaraKeluar[data.discharge_status]
                    ekcoder_nik = data.coder_nik
                    eknama_dokter = data.dokter
                    ektarif_poli_eks = data.tarif_poli_eks
                    ekkode_tarif = data.kodetarif
                    ektension_upper = $("#aetension_upper").val()
                    ektension_below = $("#aetension_below").val()
                    ekadl_sub_acute = data.adl_sub_acute
                    ekadl_chronic = data.adl_chronic
                    ekdializer_single_use = data.dializer_single_use
                    ekkantong_darah = data.kantong_darah
                    ekkelas_rawat = data.klsrawat
                    ekbirth_weight = data.birthweight

                    ekupgrade_class_ind = data.upgrade_class_id
                    ekupgrade_class_class = data.upgrade_class_class
                    ekupgrade_class_los = data.upgrade_class_los
                    ekadd_payment_pct = data.add_payment_pct
                    ekupgrade_class_payor = data.upgrade_class_payor

                    ekicu_indikator = data.icu_indikator
                    ekicu_los = data.icu_los
                    ekventilator_hour = data.ventilator_hour
                    // ekuse_ind = ''
                    // ekstart_dttm = ''
                    // ekstop_dttm = ''

                    // ekapgar = ''
                    // ekappearance = ''
                    // ekpulse = ''
                    // ekgrimace = ''
                    // ekactivity = ''
                    // ekrespiration = ''

                    // ekpersalinan = ''
                    // ekusia_kehamilan = ''
                    // ekonset_kontraksi = ''
                    // ekgravida = ''
                    // ekpartus = ''
                    // ekabortus = ''
                    // ekdelivery_method = ''
                    // ekuse_manual = ''
                    // ekuse_forcep = ''
                    // ekuse_vacuum = ''
                    // ekletak_janin = ''
                    // ekkondisi = ''

                    // ekcovid_indicator = ''
                    // ekcovid19_status_cd = ''
                    // ekcovid19_no_sep = ''
                    // eknomor_kartu_t = ''
                    // ekterapi_konvalesen = ''
                    // ekisoman_ind = ''
                    // ekbayi_lahir_status_cd = ''
                    // ekcovid19_rs_darurat_ind = ''
                    // ekcovid19_cc_ind = ''
                    // ekcovid19_co_insidense_ind = ''
                    // ekepisodes7 = ''
                    // ekepisodes8 = ''
                    // ekepisodes9 = ''
                    // ekepisodes10 = ''
                    // ekepisodes11 = ''
                    // ekepisodes12 = ''
                    // eklab_asam_laktat = ''
                    // eklab_d_dimer = ''
                    // eklab_anti_hiv = ''
                    // eklab_procalcitonin = ''
                    // eklab_analisa_gas = ''
                    // eklab_crp = ''
                    // eklab_pt = '';
                    // eklab_aptt = ''
                    // eklab_albumin = ''
                    // eklab_kultur = ''
                    // eklab_waktu_pendarahan = ''
                    // ekrad_thorax_ap_pa = ''
                    // ekpemulasaraan_jenazah = ''
                    // ekkantong_jenazah = ''
                    // ekpeti_jenazah = ''
                    // ekplastik_erat = ''
                    // ekdesinfektan_jenazah = ''
                    // ekmobil_jenazah = ''
                    // ekdesinfektan_mobil_jenazah = ''


                    ekprosedur_non_bedah = parseFloat(data.proc_nonbedah)
                    ekprosedur_bedah = parseFloat(data.proc_bedah)
                    ekkonsultasi = parseFloat(data.konsultasi)
                    ektenaga_ahli = parseFloat(data.tenaga_ahli)
                    ekkeperawatan = parseFloat(data.keperawatan)
                    ekpenunjang = parseFloat(data.penunjang)
                    ekradiologi = parseFloat(data.radiologi)
                    eklaboratorium = parseFloat(data.laboratorium)
                    ekpelayanan_darah = parseFloat(data.pelayanandarah)
                    ekrehabilitasi = parseFloat(data.rehabilitasi)
                    ekkamar = parseFloat(data.kamar)
                    ekrawat_intensif = parseFloat(data.rawat_intensif)
                    ekobat = parseFloat(data.obat)
                    ekobat_kronis = parseFloat(data.obatkronis)
                    ekobat_kemoterapi = parseFloat(data.obatkemoterapi)
                    ekalkes = parseFloat(data.alkes)
                    ekbmhp = parseFloat(data.bmhp)
                    eksewa_alat = parseFloat(data.sewa_alat)

                    ektotalBillEklaim =
                        ekprosedur_non_bedah +
                        ekprosedur_bedah +
                        ekkonsultasi +
                        ektenaga_ahli +
                        ekkeperawatan +
                        ekpenunjang +
                        ekradiologi +
                        eklaboratorium +
                        ekpelayanan_darah +
                        ekrehabilitasi +
                        ekkamar +
                        ekrawat_intensif +
                        ekobat +
                        ekobat_kronis +
                        ekobat_kemoterapi +
                        ekalkes +
                        ekbmhp +
                        eksewa_alat;

                    if (ektotalBillEklaim == 0.0) {
                        getBillEklaim18('<?= $visit['trans_id']; ?>')
                    }

                    var respon01 = JSON.parse(data.respon_01)
                    var respon02 = JSON.parse(data.respon_02)
                    var respon03 = JSON.parse(data.respon_03)

                    if (typeof respon01 !== 'undefined') {
                        if (respon01.metadata.code == 200) {
                            currentStep = 1
                            if (typeof respon02 !== 'undefined') {
                                if (respon02.metadata.code == 200) {
                                    currentStep = 2
                                    if (typeof respon03 !== 'undefined') {
                                        if (respon03.metadata.code == 200) {
                                            currentStep = 3

                                        }
                                    }
                                }
                            }
                        }
                    }



                    grouperResp = JSON.parse(data.respon_03)


                    setGrouperResult(grouperResp)
                    if (currentStep == 3) {
                        $("#ekfinalklaimbtn").show()
                    }
                    if (currentStep < 3) {
                        $("#ekfinalklaimbtn").hide()
                    }
                    if (ekklaim_final > 1) {
                        $("#ekformsubmit").hide()
                        $("#ekfinalklaimbtn").hide()
                        $("#ekeditbtn").show()
                        setEnableEklaim(true)
                    }
                    setEklaimData()

                } else {
                    if (ektotalBillEklaim == 0.0) {
                        getBillEklaim18('<?= $visit['trans_id']; ?>')
                    }
                    setEklaimData()
                }



            },
            error: function() {

            }
        });
    }

    function getBillEklaim18(trans) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getBillEklaim18',
            type: "POST",
            data: JSON.stringify({
                'trans': trans
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                ekprosedur_non_bedah = parseFloat(data.prosedur_non_bedah)
                ekprosedur_bedah = parseFloat(data.prosedur_bedah)
                ekkonsultasi = parseFloat(data.konsultasi)
                ektenaga_ahli = parseFloat(data.tenaga_ahli)
                ekkeperawatan = parseFloat(data.keperawatan)
                ekpenunjang = parseFloat(data.penunjang)
                ekradiologi = parseFloat(data.radiologi)
                eklaboratorium = parseFloat(data.laboratorium)
                ekpelayanan_darah = parseFloat(data.pelayanan_darah)
                ekrehabilitasi = parseFloat(data.rehabilitasi)
                ekkamar = parseFloat(data.kamar)
                ekrawat_intensif = parseFloat(data.rawat_intensif)
                ekobat = parseFloat(data.obat)
                ekobat_kronis = parseFloat(data.obat_kronis)
                ekobat_kemoterapi = parseFloat(data.obat_kemoterapi)
                ekalkes = parseFloat(data.alkes)
                ekbmhp = parseFloat(data.bmhp)
                eksewa_alat = parseFloat(data.sewa_alat)

                ektotalBillEklaim = ekprosedur_non_bedah +
                    ekprosedur_bedah +
                    ekkonsultasi +
                    ektenaga_ahli +
                    ekkeperawatan +
                    ekpenunjang +
                    ekradiologi +
                    eklaboratorium +
                    ekpelayanan_darah +
                    ekrehabilitasi +
                    ekkamar +
                    ekrawat_intensif +
                    ekobat +
                    ekobat_kronis +
                    ekobat_kemoterapi +
                    ekalkes +
                    ekbmhp +
                    eksewa_alat;


                $("#ekprosedur_non_bedah").val((ekprosedur_non_bedah))
                $("#ekprosedur_bedah").val((ekprosedur_bedah))
                $("#ekkonsultasi").val((ekkonsultasi))
                $("#ektenaga_ahli").val((ektenaga_ahli))
                $("#ekkeperawatan").val((ekkeperawatan))
                $("#ekpenunjang").val((ekpenunjang))
                $("#ekradiologi").val((ekradiologi))
                $("#eklaboratorium").val((eklaboratorium))
                $("#ekpelayanan_darah").val((ekpelayanan_darah))
                $("#ekrehabilitasi").val((ekrehabilitasi))
                $("#ekkamar").val((ekkamar))
                $("#ekrawat_intensif").val((ekrawat_intensif))
                $("#ekobat").val((ekobat))
                $("#ekobat_kronis").val((ekobat_kronis))
                $("#ekobat_kemoterapi").val((ekobat_kemoterapi))
                $("#ekalkes").val((ekalkes))
                $("#ekbmhp").val((ekbmhp))
                $("#eksewa_alat").val((eksewa_alat))
                $("#ektgl_lahir").val(data.date_of_birth)

                $("#ekbilling_amount").val(formatCurrency(ektotalBillEklaim))

            },
            error: function() {

            }
        });
    }

    function setGrouperResult(data) {
        if (data.metadata.code == 200) {
            var response = data.response
            var cbg = response.cbg
            var totalIna = 0.0
            if (typeof cbg !== 'undefined') {
                $("#cbgdescription").html(cbg.description)
                $("#cbgcode").html(cbg.code)
                $("#cbgtariff").html(formatCurrency(parseFloat(cbg.tariff)))
                if (typeof cbg.base_tariff !== 'undefined') {
                    $("#cbgtariff").html(formatCurrency(parseFloat(cbg.base_tariff)))
                    totalIna += parseFloat(cbg.base_tariff)
                } else
                    totalIna += parseFloat(cbg.tariff)
            }
            var sub_acute = response.sub_acute
            if (typeof sub_acute !== 'undefined') {
                $("#sub_acutedescription").html(sub_acute.description)
                $("#sub_acutecode").html(sub_acute.code)
                $("#sub_acutetariff").html(formatCurrency(parseFloat(sub_acute.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var chronic = response.chronic
            if (typeof chronic !== 'undefined') {
                $("#chronicdescription").html(chronic.description)
                $("#chroniccode").html(chronic.code)
                $("#chronictariff").html(formatCurrency(parseFloat(chronic.tariff)))
                totalIna += parseFloat(sub_acute.tariff)
            }
            var special_cmg_option = data.special_cmg_option
            special_cmg_option.forEach((element, key) => {
                var code = special_cmg_option[key].code
                var description = special_cmg_option[key].description
                var type = special_cmg_option[key].type
                type = type.replace(/\s+/g, '_').toLowerCase();
                $("#" + type + "description").append($("<option>").attr("value", code).html(description).attr("onclick", 'postGrouper2("' + type + '","' + code + '")'))
                $("#" + type + "description").prop("disabled", false)
            });
            var special_cmg_result = data.response.special_cmg
            if (typeof special_cmg_result !== 'undefined') {
                special_cmg_result.forEach((element, key) => {
                    var code = special_cmg_result[key].code
                    var description = special_cmg_result[key].description
                    var type = special_cmg_result[key].type
                    var tariff = special_cmg_result[key].tariff
                    type = type.replace(/\s+/g, '_').toLowerCase();
                    $("#" + type + "description").find('option[text="' + description + '"]').val();
                    $("#" + type + "tariff").html(formatCurrency(parseFloat(tariff)))
                    $("#" + type + "code").html(code)
                    totalIna += parseFloat(tariff)

                });
            }

            $("#totalGrouper").html(formatCurrency(totalIna))

        } else {
            errorMsg(data.metadata.message);
        }
    }
    var eklaimhasil;
    $("#formeklaim").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postEklaim',
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
                setGrouperResult(data)
                if (currentStep < 3) {
                    $("#ekfinalklaimbtn").hide()
                } else {
                    $("#ekfinalklaimbtn").show()
                }
                clicked_submit_btn.button('reset');
                // successMsg(data.message);
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
                errorMsg(xhr);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));

    function postGrouper2(type, code) {
        $("#" + type + "code").html(code)

        var collectCode = '';
        var specialProcedure = $("#special_proceduredescription").val()
        var specialProsthesis = $("#special_prosthesisdescription").val()
        var specialInvestigation = $("#special_investigationdescription").val()
        var specialDrug = $("#special_drugdescription").val()

        if (specialProcedure != '-' && specialProcedure != '') {
            collectCode += specialProcedure + "#"
        }
        if (specialProsthesis != '-' && specialProsthesis != '') {
            collectCode += specialProsthesis + "#"
        }
        if (specialInvestigation != '-' && specialInvestigation != '') {
            collectCode += specialInvestigation + "#"
        }
        if (specialDrug != '-' && specialDrug != '') {
            collectCode += specialDrug + "#"
        }
        collectCode = collectCode.substring(0, collectCode.length - 1)
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postGrouper2',
            type: "POST",
            data: JSON.stringify({
                'type': type,
                'code': collectCode,
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#ekformsubmit").button('loading')
            },
            success: function(data) {
                setGrouperResult(data)
                $("#ekformsubmit").button('reset')
            },
            error: function() {
                $("#ekformsubmit").button('reset')
            }
        });
    }

    function finalKlaim() {
        $("#ekfinalklaimbtn").button('loading')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/finalKlaim',
            type: "POST",
            data: JSON.stringify({
                'coder_nik': ekcoder_nik,
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#ekfinalklaimbtn").button('loading')
            },
            success: function(data) {
                if (data.metadata.code == 200) {
                    $("#ekeditbtn").show()
                    $("#ekfinalklaimbtn").hide()
                    $("#ekformsubmit").hide()

                    setEnableEklaim(true)
                }
            },
            error: function() {

            },
            complete: function() {
                $("#ekfinalklaimbtn").button('reset')
            }
        });
    }

    function editKlaim() {
        $("#ekeditbtn").button('loading')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editKlaim',
            type: "POST",
            data: JSON.stringify({
                'nomor_sep': eknomor_sep
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == 200) {
                    $("#ekeditbtn").hide()
                    $("#ekfinalklaimbtn").show()
                    $("#ekformsubmit").show()
                    setEnableEklaim(false)
                }
                $("#ekeditbtn").button('reset')

            },
            error: function() {

            }
        });
    }
</script>