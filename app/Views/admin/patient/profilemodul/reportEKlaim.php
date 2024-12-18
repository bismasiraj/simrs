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
<div class="tab-pane" id="reportEKlaim" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <div class="row mt-4">

            </div>
            <!-- <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div> -->
            <div class="table-responsive">
                <div class="accordion" id="accodrionFormEklaim">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="ranapFile_pendukung">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                                <b>Rawat Inap File Pendukung</b>
                            </button>
                        </h2>
                        <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis"
                            data-bs-parent="#accodrionFormEklaim">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="ranapFile_url" class="list-group list-group-flush">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rajalFile_pendukung">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsekeperawatan" aria-expanded="true"
                                aria-controls="collapsekeperawatan">
                                <b>Rawat Jalan File Pendukung Poli</b>
                            </button>
                        </h2>
                        <div id="collapsekeperawatan" class="accordion-collapse collapse" aria-labelledby="keperawatan"
                            data-bs-parent="#accodrionFormEklaim">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="rajalFile_url" class="list-group list-group-flush">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rajaFile_igd">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapselainnya" aria-expanded="true" aria-controls="collapselainnya">
                                <b>Rawat Jalan IGD</b>
                            </button>
                        </h2>
                        <div id="collapselainnya" class="accordion-collapse collapse" aria-labelledby="lainnya"
                            data-bs-parent="#accodrionFormEklaim">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul id="rajalFileIgd_url" class="list-group list-group-flush">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--./row-->
</div>
<!-- -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=SEP' + '" target="_blank">SEP</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=SRI' +
    '" target="_blank">Surat Rawat Inap</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=TRIASE' +
    '" target="_blank" >Asesman Igd Triase</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=ResumeMedis' + '" target="_blank">Resume Pulang</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '" target="_blank" class="text-danger">Laporan Persalinan</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '" target="_blank" class="text-danger">Laporan Operasi</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/rm/medis/resume_medis/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '" target="_blank" class="text-danger">Laporan Anestesi</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=PNJG' +
    '" target="_blank">Hasil Penunjang dan Bacaan</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=ANOTOMI' +
    '" target="_blank">Hasil Bacaan Patologi Anatomi</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF&type=INV' + '" target="_blank">Nota Kasir</a></li>')
$('#ranapFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RIF' + '" target="_blank" class="text-success">All</a></li>')


// ===============================================================================================================================
$('#rajalFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJF&type=SEP' + '" target="_blank">SEP</a></li>')
$('#rajalFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJF&type=SRI' + '" target="_blank">Surat Kontrol</a></li>')
$('#rajalFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJF&type=PNJG' + '" >Asesman Hasil Penunjang</a></li>'
)
$('#rajalFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJF&type=INV' + '" target="_blank">Nota Kasir</a></li>')
$('#rajalFile_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJF' + '" target="_blank">All</a></li>')


// ===============================================================================================================================
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI&type=SEP' + '" target="_blank">SEP</a></li>')
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI&type=SRI' + '" target="_blank">Surat Keterangan Diagnosa</a></li>')
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI&type=TRIASE' + '" target="_blank" >Asesman Igd</a></li>')
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI&type=PNJG' + '" target="_blank">Hasil Penunjang</a></li>')
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI&type=INV' + '" target="_blank">Nota Kasir</a></li>')
$('#rajalFileIgd_url').append(
    '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/Cetak/cetakAllGrouping/' . base64_encode(json_encode($visit)); ?>' +
    '/' + $("#armbody_id").val() + '?result=RJI' + '" target="_blank" >All</a></li>')
</script>