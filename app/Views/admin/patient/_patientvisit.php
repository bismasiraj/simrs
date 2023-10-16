<?php
$currency_symbol = 'Rp. ';
?>
<div class="box border0 clear" id="visit_report">
    <h4 class="mb0"><?= lang("Word.patient_visit_report"); ?></h4>
    <div class="table-responsive">
        <div class="download_label"><?php echo lang('Word.opd_report'); ?></div>
        <div class="ptt10">
            <a class="btn btn-default btn-xs pull-right" id="print" onclick="printDiv()"><i class="fa fa-print"></i></a>
            <a class="btn btn-default btn-xs pull-right" id="btnExport" onclick="tablesToExcel(array1, array2, array3, array4, array5, array6, array7, 'myfile.xls');"> <i class="fa fa-file-excel-o"></i> </a>
        </div>
        <table class="table table-striped table-bordered table-hover allajaxlist" id="1">
            <caption>
                <h4 class="bolds"><?= lang("Word.opd_details"); ?></h4>
            </caption>
            <thead>
                <tr>
                    <th style="display: none;">Kode Booking</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Asuransi</th>
                    <th width="20%">SEP</th>
                    <th width="20%">Kelas</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($opd_data)) {
                    foreach ($opd_data as  $value) {
                        if ($value['name_of_class_room'] == null || $value['name_of_class_room'] == '') {
                ?>
                            <tr>
                                <td style="display: none;"><?php echo $value['visit_id']; ?><br><?= $value['trans_id']; ?></td>
                                <td><?php echo $value['visit_date']; ?></td>
                                <td><?php echo $value['fullname']; ?></td>
                                <td><?= $value['name_of_clinic']; ?></td>
                                <td><?= $value['name_of_status_pasien']; ?></td>
                                <td><?php echo $value['no_skp']; ?></td>
                                <td><?php echo $value['name_of_class']; ?></td>
                                <td>
                                    <div class="btn-group" style="margin-left:2px;"><a href="#" style="width: 20px;border-radius: 2px;" class="btn btn-default btn-xs" data-toggle="dropdown" title="show" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu dropdown-menu2" role="menu">
                                            <li><a href="<?= base_url(); ?>admin/patient/profile/<?= $value['visit_id']; ?>" class="btn btn-default btn-xs" data-toggle="" title="" target="_blank">Rawat Jalan</a></li>
                                            <li><a href="<?= base_url(); ?>admin/patient/ipdprofile/846202" class="btn btn-default btn-xs" data-toggle="" title="" target="_blank">Rawat Inap</a></li>
                                            <li><a href="<?= base_url(); ?>admin/radio/getTestReportBatch" class="btn btn-default btn-xs" data-toggle="" title="" target="_blank">Radiologi</a></li>
                                            <li><a href="<?= base_url(); ?>admin/pathology/getTestReportBatch" class="btn btn-default btn-xs" data-toggle="" title="" target="_blank">Lab</a></li>
                                            <li><a href="<?= base_url(); ?>admin/pharmacy/bill" class="btn btn-default btn-xs" data-toggle="" title="" target="_blank">Farmasi</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                <?php }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <div class="download_label"><?php echo "Rawat Inap"; ?></div>
        <table class="table table-striped table-bordered table-hover allajaxlist" id="2">
            <caption>
                <h4 class="bolds"><?= lang("Word.ipd_details"); ?></h4>
            </caption>
            <thead>
                <tr>
                    <th style="display: none;">Kode Booking</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Dokter</th>
                    <th>Bangsal</th>
                    <th>Asal Rujukan</th>
                    <th>Status Ranap</th>
                    <th>Asuransi</th>
                    <th>SEP</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($opd_data)) {
                    foreach ($opd_data as $key => $value) {

                        if ($value['name_of_class_room'] != null && $value['name_of_class_room'] != '') {
                ?>
                            <tr>
                                <td style="display: none;"><?php echo $value['visit_id']; ?><br><?= $value['trans_id']; ?></td>
                                <td><?php echo $value['in_date']; ?> - <?= $value['exit_date']; ?></td>
                                <td><?php echo $value['fullnameranap']; ?></td>
                                <td><?= $value['name_of_class_room']; ?></td>
                                <td><?= $value['name_of_clinic']; ?></td>
                                <td><?php echo $value['cara_keluar']; ?></td>
                                <td><?php echo $value['name_of_status_pasien']; ?></td>
                                <td><?php echo $value['no_skpinap']; ?></td>
                                <td><?php echo $value['name_of_class']; ?></td>
                            <tr>

                    <?php
                        }
                    }
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function viewDetailBill(id) {
        $.ajax({
            url: baseurl + 'admin/patient/getBillDetails/' + id,
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $('#reportdata').html(data);

                holdModal('viewModalBill');
            },
        });
    }
</script>
<script>
    function viewDetail(id) {
        var view_modal = $('#viewModal');
        $.ajax({
            url: baseurl + 'admin/patient/getpharmacybilldetails/',
            type: "GET",
            data: {
                'id': id
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#reportdata,#edit_deletebill').html("");
                $('#viewModal').modal('show');
                view_modal.addClass('modal_loading');
            },
            complete: function() {
                view_modal.removeClass('modal_loading');
            },
            success: function(data) {
                $('#pharmacy_reportdata').html(data.page);

                view_modal.removeClass('modal_loading');
            },
        });
    }
</script>