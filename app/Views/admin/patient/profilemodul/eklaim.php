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
<div class="tab-pane" id="klaim" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
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
                                <div class="mt-4 mb-3 row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label for="eknomor_sep" class="col-md-3 col-form-label">No. SEP</label>
                                            <div class="col-md-9">
                                                <input onchange="eklaimInput(this)" type="text" name="nomor_sep" id="eknomor_sep" placeholder="" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label for="eknomor_kartu" class="col-md-4 col-form-label">No. Kartu</label>
                                            <div class="col-md-8">
                                                <input onchange="eklaimInput(this)" type="text" name="nomor_kartu" id="eknomor_kartu" placeholder="" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label for="ekpayor" class="col-md-4 col-form-label">Jaminan / Cara Bayar</label>
                                            <div class="col-md-8">
                                                <select name="payor" id="ekpayor" class="form-select">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label for="eknomor_kartu" class="col-md-2 col-form-label">COB</label>
                                            <div class="col-md-10">
                                                <select name="cob_cd" id="ekcob_cd" class="form-select">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <h3>
                                    Parameter Klaim
                                </h3>
                                <hr>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Jenis Rawat</td>
                                            <td>
                                                <select name="jenis_rawat" id="ekjenis_rawat" class="form-select">
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
                                                    <select name="kelas_rawat" id="ekkelas_rawat" class="form-select">
                                                        <option value="3">Regular</option>
                                                        <option value="1">Eksekutif</option>
                                                    </select>
                                                </td>
                                            <?php } else { ?>
                                                <td>Kelas Hak</td>
                                                <td>
                                                    <select name="kelas_rawat" id="ekkelas_rawat" class="form-select">
                                                        <option value="3">Kelas 3</option>
                                                        <option value="2">Kelas 2</option>
                                                        <option value="1">Kelas 1</option>
                                                    </select>
                                                </td>
                                            <?php } ?>


                                        </tr>
                                        <tr>

                                            <td>Tanggal Masuk</td>
                                            <td>
                                                <div>
                                                    <div class="input-group" id="ektgl_masuk_group">
                                                        <input id="flatektgl_masuk" type="text" class="form-control datetimeflatpickr" placeholder="yyyy-mm-dd">
                                                        <input id="ektgl_masuk" name="tgl_masuk" type="hidden" class="form-control" placeholder="yyyy-mm-dd">

                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                    </div>
                                                    <!-- input-group -->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Keluar</td>
                                            <td>
                                                <div>
                                                    <div class="input-group" id="ektgl_pulang_group">
                                                        <input id="flatektgl_pulang" type="text" class="form-control datetimeflatpickr" placeholder="yyyy-mm-dd">
                                                        <input id="ektgl_pulang" name="tgl_pulang" type="hidden" class="form-control" placeholder="yyyy-mm-dd">

                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                    </div>
                                                    <!-- input-group -->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Berat Lahir</td>
                                            <td><input onchange="eklaimInput(this)" type="text" name="birth_weight" id="ekbirth_weight" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Cara Masuk</td>
                                            <td colspan="3">
                                                <select name="cara_masuk" id="ekcara_masuk" class="form-select">
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
                                                <select name="discharge_status" id="ekdischarge_status" class="form-select">
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

                                <table class="table table-borderless mb-0">
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
                                                <select name="dializer_single_use" id="ekdializer_single_use" class="form-select">
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
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="20">Naik Kelas</td>
                                                <td>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimupgrade_class_ind1" class="form-check-input" type="radio" name="upgrade_class_ind" value="1" onclick="showHideEklaim('upgradeClassParam',1)">
                                                        <label class="form-check-label" for="eklaimupgrade_class_ind1">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimupgrade_class_ind0" class="form-check-input" type="radio" name="upgrade_class_ind" value="0" onclick="showHideEklaim('upgradeClassParam',0)" checked>
                                                        <label class="form-check-label" for="eklaimupgrade_class_ind0">Tidak</label>
                                                    </div>
                                                </td>
                                                <td class="upgradeClassParam">=></td>
                                                <td class="upgradeClassParam">Menjadi Kelas</td>
                                                <td class="upgradeClassParam">
                                                    <select name="upgrade_class_class" id="ekupgrade_class_class" class="form-select">
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
                                                    <select name="upgrade_class_payor" id="ekupgrade_class_payor" class="form-select">
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
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimicu_indikator1" class="form-check-input" type="radio" name="icu_indikator" value="1" onclick="showHideEklaim('icuParam',1)">
                                                        <label class="form-check-label" for="eklaimicu_indikator1">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimicu_indikator0" class="form-check-input" type="radio" name="icu_indikator" value="0" onclick="showHideEklaim('icuParam',0)" checked>
                                                        <label class="form-check-label" for="eklaimicu_indikator0">Tidak</label>
                                                    </div>
                                                    <!-- <label class="radio-inline"><input type="radio" value="1" name="icu_indikator" onclick="showHideEklaim('icuParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="icu_indikator" onclick="showHideEklaim('icuParam',0)" checked>Tidak</label> -->
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
                                                    <select name="use_ind" id="ekuse_ind" class="form-select">
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
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimapgar1" class="form-check-input" type="radio" name="apgar" value="1" onclick="showHideEklaim('apgarParam',1)">
                                                        <label class="form-check-label" for="eklaimapgar1">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimapgar0" class="form-check-input" type="radio" name="apgar" value="0" onclick="showHideEklaim('apgarParam',0)" checked>
                                                        <label class="form-check-label" for="eklaimapgar0">Tidak</label>
                                                    </div>
                                                    <!-- <label class="radio-inline"><input type="radio" value="1" name="apgar" onclick="showHideEklaim('apgarParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="apgar" onclick="showHideEklaim('apgarParam',0)" checked>Tidak</label> -->
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
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimpersalinan1" class="form-check-input" type="radio" name="persalinan" value="1" onclick="showHideEklaim('persalinanParam',1)">
                                                        <label class="form-check-label" for="eklaimpersalinan1">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimpersalinan0" class="form-check-input" type="radio" name="persalinan" value="0" onclick="showHideEklaim('persalinanParam',0)" checked>
                                                        <label class="form-check-label" for="eklaimpersalinan0">Tidak</label>
                                                    </div>
                                                    <!-- <label class="radio-inline"><input type="radio" value="1" name="persalinan" onclick="showHideEklaim('persalinanParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="persalinan" onclick="showHideEklaim('persalinanParam',0)" checked>Tidak</label> -->
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
                                                    <select name="onset_kontraksi" id="ekonset_kontraksi" class="form-select">
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
                                                    <select name="delivery_method[]" id="ekdelivery_method" class="form-select">
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
                                                    <select name="letak_janin[]" id="ekletak_janin" class="form-select">
                                                        <option value="kepala">Kepala</option>
                                                        <option value="sungsang">Sungsang</option>
                                                        <option value="lintang">Lintang</option>
                                                    </select>
                                                </td>
                                                <td class="persalinanBody persalinanBodyright">
                                                    <select name="kondisi[]" id="ekkondisi" class="form-select">
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
                                                    <button type="button" id="ekformdiag" name="adddiagnosa" onclick="modalDiagnosa()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Tambah</span></button>

                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Covid-19</td>
                                                <td>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimcovid_indicator1" class="form-check-input" type="radio" name="covid_indicator" value="1" onclick="showHideEklaim('covidParam',1)">
                                                        <label class="form-check-label" for="eklaimcovid_indicator1">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input id="eklaimcovid_indicator0" class="form-check-input" type="radio" name="covid_indicator" value="0" onclick="showHideEklaim('covidParam',0)" checked>
                                                        <label class="form-check-label" for="eklaimcovid_indicator0">Tidak</label>
                                                    </div>
                                                    <!-- <label class="radio-inline"><input type="radio" value="1" name="covid_indicator" onclick="showHideEklaim('covidParam',1)">Ya</label>
                                                    <label class="radio-inline"><input type="radio" value="0" name="covid_indicator" onclick="showHideEklaim('covidParam',0)" checked>Tidak</label> -->
                                                </td>
                                                <td class="covidParam">=></td>
                                                <td class="covidParam">Status CD</td>
                                                <td class="covidParam" colspan="2">
                                                    <select name="covid19_status_cd" id="ekcovid19_status_cd" class="form-select">
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
                                                    <select name="nomor_kartu_t" id="eknomor_kartu_t" class="form-select">
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
                                                    <select name="isoman_ind" id="ekisoman_ind" class="form-select">
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
                                                    <select name="bayi_lahir_status_cd" id="ekbayi_lahir_status_cd" class="form-select">
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
                                                    <select name="covid19_rs_darurat_ind" id="ekcovid19_rs_darurat_ind" class="form-select">
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
                                                    <select name="covid19_cc_ind" id="ekcovid19_cc_ind" class="form-select">
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
                                                    <select name="covid19_co_insidense_ind" id="ekcovid19_co_insidense_ind" class="form-select">
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

                            </div><!--./col-lg-12-->
                            <hr>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Tarif Rumah Sakit</h3>
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="text-align:right;"></td>
                                            <td style="border-left:0;"></td>
                                            <td style="text-align:right;">Tarif Rumah Sakit :</span>&nbsp;<span style="font-size:1.11em;color:#888;">Rp</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="billing_amount" id="ekbilling_amount" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;"></td>
                                            <td style="border-left:0;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Prosedur Non Bedah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="prosedur_non_bedah" id="ekprosedur_non_bedah" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Prosedur Bedah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="prosedur_bedah" id="ekprosedur_bedah" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Konsultasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="konsultasi" id="ekkonsultasi" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Tenaga Ahli</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="tenaga_ahli" id="ektenaga_ahli" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Keperawatan</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="keperawatan" id="ekkeperawatan" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Penunjang</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="penunjang" id="ekpenunjang" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Radiologi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="radiologi" id="ekradiologi" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Laboratorium</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="laboratorium" id="eklaboratorium" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Pelayanan Darah</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="pelayanan_darah" id="ekpelayanan_darah" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Rehabilitasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="rehabilitasi" id="ekrehabilitasi" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Kamar / Akomodasi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="kamar" id="ekkamar" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">KamRawat Intensif</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="rawat_intensif" id="ekrawat_intensif" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Obat</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="obat" id="ekobat" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Obat Kronis</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="obat_kronis" id="ekobat_kronis" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Obat Kemoterapi</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="obat_kemoterapi" id="ekobat_kemoterapi" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Alkes</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="alkes" id="ekalkes" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">BMHP</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="bmhp" id="ekbmhp" onkeydown="kp_chg_billing(this,event);"></td>
                                            <td style="text-align:right;">Sewa Alat</td>
                                            <td style="border-left:0;"><input type="text" autocomplete="off" readonly="1" class="billing_group" onclick="_dsa(this);" style="text-align:right;width:8em;" value="0" name="sewa_alat" id="eksewa_alat" onkeydown="kp_chg_billing(this,event);"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- col-sm-12 col-md-12 col-lg-12 -->
                            <div class="col-md-12">
                                <div class="dividerhr"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mt-4">
                                <h3>Coding UNU Grouper</h3>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
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
                                        <button type="button" id="ekunuDiagAdd" onclick="addUnuDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Diagnosa UNU</span></button>
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
                                        <button type="button" id="ekunuProcAdd" onclick="addUnuProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Prosedur UNU</span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mt-4">
                                <h3>Coding INA Grouper</h3>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
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
                                        <button type="button" id="ekinaDiagAdd" onclick="addInaDiag()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Diagnosa INA</span></button>
                                    </div>

                                </div>
                                <div class="staff-members">
                                    <div class="table tablecustom-responsive">
                                        <table class="table table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
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
                                        <button type="button" id="ekinaProcAdd" onclick="addInaProc()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <span>Prosedur INA</span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                                <h3>
                                    Hasil Grouper E-Klaim v5
                                </h3>
                                <table class="table table-striped table-hover" style="width:100%;">
                                    <colgroup>
                                        <col width="190">
                                        <col>
                                        <col width="70">
                                        <col width="127">
                                    </colgroup>
                                    <thead class="table-primary">
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
                                                            <td><select name="special_procedure" id="special_proceduredescription" class="form-select" style="width: 50%;" disabled>
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
                                                            <td><select name="special_prosthesis" id="special_prosthesisdescription" class="form-select" style="width: 50%;" disabled>
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
                                                            <td><select name="special_investigation" id="special_investigationdescription" class="form-select" style="width: 50%;" disabled>
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
                                                            <td><select name="special_drug" id="special_drugdescription" class="form-select" style="width: 50%;" disabled>
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
                <div class="">
                    <div class="panel-footer text-end mb-4">
                        <button type="button" id="ekfinalklaimbtn" onclick="finalKlaim()" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Final Klaim</button>
                        <button type="submit" id="ekformsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="ekeditbtn" onclick="editKlaim()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                        <button type="button" id="" onclick="" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                        <a href="<?= base_url() . '/admin/cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>" target="_blank">All Template</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->