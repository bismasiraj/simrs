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
<div class="tab-pane" id="rm" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <div class="row mt-4">

            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div>
            <div class="table-responsive">
                <div class="accordion" id="accodrionFormRm">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="medis">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                                <b>MEDIS</b>
                            </button>
                        </h2>
                        <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="medisListLink" class="list-group list-group-flush">
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_bedah/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Bedah</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_dalam/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Dalam</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_kulit_kelamin/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Kulit Kelamin</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_mata/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan Mata</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ralan_tht/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ralan THT</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_dalam/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Dalam</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_neonatal/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Neonatal</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/ranap_paru/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Ranap Paru</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/rawat_inap/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Medis Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Reconsialisasi Obat</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>" target="_blank">Resume Medis</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Keterangan Diagnosis</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Kontrol Pasien BPJS</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>" target="_blank">Surat Perintah Rawat Inap</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="keperawatan">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsekeperawatan" aria-expanded="true" aria-controls="collapsekeperawatan">
                                <b>KEPERAWATAN</b>
                            </button>
                        </h2>
                        <div id="collapsekeperawatan" class="accordion-collapse collapse" aria-labelledby="keperawatan" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="keperawatanListLink" class="list-group list-group-flush">
                                            <!-- <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ralan Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ralan_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ralan Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ranap_kandungan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Kandungan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cetak_keperawatan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Assessmen Keperawatan Ranap Neonatus</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Asuhan Gizi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Asuhan Kebidanan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ranap/' . base64_encode(json_encode($visit)); ?>" target="_blank">CPPT Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/cppt_ralan/' . base64_encode(json_encode($visit)); ?>" target="_blank">CPPT Rawat Jalan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Diagnosis Keperawatan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Edukasi Integrasi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>" target="_blank">Edukasi Obat Oleh Apoteker</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Formulir Pemberian Edukasi</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/hak_dan_kewajiban/' . base64_encode(json_encode($visit)); ?>" target="_blank">Hak dan Kewajiban Pasien</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/implementasi/' . base64_encode(json_encode($visit)); ?>" target="_blank">Implementasi Asuhan Keperawatan</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/inform_concern/' . base64_encode(json_encode($visit)); ?>" target="_blank">Inform Concern (Pemasangan Infus)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_anak/' . base64_encode(json_encode($visit)); ?>" target="_blank">Keperawatan IGD Anak</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/igd_dewasa/' . base64_encode(json_encode($visit)); ?>" target="_blank">Keperawatan IGD Dewasa</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>" target="_blank">Monitoring Nyeri</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>" target="_blank">Monitoring Resiko Jatuh</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>" target="_blank">Persetujuan Umum (General Concert)</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>" target="_blank">SDKI SLKI SIKI</a></li>
                                            <li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>" target="_blank">Transfer Internal</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="lainnya">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapselainnya" aria-expanded="true" aria-controls="collapselainnya">
                                <b>LAIN-LAIN</b>
                            </button>
                        </h2>
                        <div id="collapselainnya" class="accordion-collapse collapse" aria-labelledby="lainnya" data-bs-parent="#accodrionFormRm">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="lainnyaListLink" class="list-group list-group-flush">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    let res = <?= json_encode($aValue); ?>;

    // let aValue = res.filter(item => item?.p_type === "GEN0012");
    let combinedData = {
        aValue: res,
        visit: <?= json_encode($visit); ?>
    };

    let jsonData = JSON.stringify(combinedData);

    let base64Data = '';
    // let base64Data = btoa(jsonData);
    let baseUrl = '<?= base_url() ?>';
    let url = baseUrl + '/admin/rm/keperawatan/transfer_internal/' + base64Data + '/' + $("#arpbody_id").val();

    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/rawat_jalan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Assessmen Medis</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/profile/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Profile Ringkas Medis Rawat Jalan</a></li>')
    $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/reklaim/CetakReklaim/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '?result=RJF&type=SKD" target="_blank">Surat Keterangan Diagnosis</a></li>')
    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Reconsialisasi Obat</a></li>')
    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/surat_diagnosis/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Keterangan Diagnosis</a></li>')
    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/surat_bpjs/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Kontrol Pasien BPJS</a></li>')
    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/surat_perintah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Surat Perintah Rawat Inap</a></li>')
</script>
<script type="text/javascript">
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_kebidanan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Kebidanan</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/diagnosis_keperawatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Diagnosis Keperawatan</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/edukasi_integrasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Edukasi Integrasi</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url(); ?>/admin/rm/keperawatan/edukasi_obat/<?= base64_encode(json_encode($visit)); ?>\')">Edukasi Obat Oleh Apoteker</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">Formulir Pemberian Edukasi</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/identitas/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Identitas dan Pernyataan Pasien Rawat Inap</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="#" target="_blank" onclick="openPopUpTab(\'<?= base_url(); ?>/admin/rm/keperawatan/implementasi/<?= base64_encode(json_encode($visit)); ?>\')">Implementasi Asuhan Keperawatan</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/monitoring_nyeri/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">Monitoring Nyeri</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/resiko_jatuh/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">Monitoring Resiko Jatuh</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/persetujuan_umum/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">Persetujuan Umum (General Concert)</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
    // $('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/sdki/' . base64_encode(json_encode($visit)); ?>' + '" target="_blank">SDKI SLKI SIKI</a></li>')
    //$('#keperawatanListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/transfer_internal/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Transfer Internal</a></li>')
    $('#keperawatanListLink').append('<li class="list-group-item"><a href="' + url + '" target="_blank">Transfer Internal</a></li>');
</script>
<script type="text/javascript">
    // $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/asuhan_gizi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Asuhan Gizi</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/keperawatan/ringkasan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '" target="_blank">Ringkasan Masuk Keluar Pasien</a></li>')
    // $('#medisListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/reconsialisasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armpasien_diagnosa_id").val() + '" target="_blank">Reconsialisasi Obat</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/keperawatan/edukasi_obat/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '\')" target="_blank">Edukasi Obat Oleh Apoteker</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/keperawatan/formulir_edukasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#arpbody_id").val() + '\')" target="_blank">Formulir Pemberian Edukasi</a></li>')
    // $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/lainnya/surat_darah/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '\')" target="_blank">Surat Permintaan Transfusi Darah</a></li>')
    // $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/lainnya/fisioterapi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '\')" target="_blank">Surat Pengantar Fisioterapi</a></li>')
    // $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/lainnya/konsultasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '\')" target="_blank">Surat Perintah Konsultasi</a></li>')
    // $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/pengobatan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank">Daftar Pengobatan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/lainnya/persalinan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '\')" target="_blank">Laporan Persalinan</a></li>')
    $('#lainnyaListLink').append('<li class="list-group-item"><a href="#" onclick="openPopUpTab(\'<?= base_url() . '/admin/rm/lainnya/sedasi/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '\')" target="_blank">Assessmen Pra Anastesi Sedasi</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_1_1/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $(" #armbody_id").val() + '" target="_blank"> RL-1_1</a></li>')

    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_1_3/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank"> RL-1_3</a></li>')

    $('#lainnyaListLink').append('<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_2/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#armbody_id").val() + '" target="_blank"> RL-2</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_3_6/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank"> RL-3_6</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_3_7/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank"> RL-3_7</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_3_8/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank"> RL-3_8</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/rl_3_9/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank"> RL-3_9</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/DocCetak/cetakGroupeRajalFilePoli/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() + '" target="_blank">Rajal File Pendukung Poli</a></li>')

    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/DocCetak/cetakGroupeRajalIgd/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() + '" target="_blank">Rajal IGD</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/DocCetak/cetakGroupeRanapFile/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() + '" target="_blank">Ranap File Pendukung</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/cppt_preview/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Catatan Perkembangan Pasien Terintegrasi</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/assessmen_preview/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Assessment</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/assessmen_perawat_preview/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Assessment Perawat</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/medis/medis_all_live/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Test Assesmen Medis All</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/rm/lainnya/icuncppt_preview/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">ICU Perawat & CPPT</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/pengobatan_oral/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Daftar Pengobatan Oral</a></li>')
    $('#lainnyaListLink').append(
        '<li class="list-group-item"><a href="<?= base_url() . '/admin/cetak/pengobatan_parenteral/' . base64_encode(json_encode($visit)); ?>' +
        '/' + $("#armbody_id").val() +
        '" target="_blank">Daftar Pengobatan Parenteral</a></li>')
</script>