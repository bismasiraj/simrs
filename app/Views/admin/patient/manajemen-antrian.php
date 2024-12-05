<?php

$this->extend('layout/basiclayout', [
    'orgunit' => @$orgunit,
    'img_time' => @$img_time
]) ?>
<?php $this->section('cssContent') ?>
<!-- DataTables -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />
<?php $this->endSection() ?>
<?php $this->section('topbar') ?>
<?php echo view('layout/partials/topbar.php', [
    'title' => @$title,
    'pagetitle' => 'dashboard',
    'subtitle' => 'dashboard',
]); ?>
<?php $this->endSection() ?>
<?php $this->section('content') ?>

<style type="text/css">
@media print {

    .no-print,
    .no-print * {
        display: none !important;
    }
}

th {
    text-align: center;
}
</style>
<?php
$currency_symbol = "Rp. ";
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card rounded-4">
                    <div class="card-body">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- <div class="box-header with-border">
                                <h3 class="box-title"><?php echo @$title ?></h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div> -->
                            <div class="box-body pb0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <form id="form-action-antrian" action="" method="post" class="">
                                                <?= csrf_field(); ?>
                                                <div class="box-body row">
                                                    <div class="col ">
                                                        <div class="mb-3">
                                                            <label class="fw-bold">Manajemen Antrian</label>
                                                            <table id="reportDataTable"
                                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                <thead id="headdata-antrian" class="table-primary">
                                                                    <th>Ruangan</th>
                                                                    <th>Klinik</th>
                                                                    <th>IP Address Display </th>
                                                                    <th>Nama Dokter</th>
                                                                    <th>Action</th>
                                                                </thead>
                                                                <tbody id="bodydata-antrian">
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                            .retrieve-data {
                                overflow-x: auto;
                                overflow-y: auto;
                            }

                            .table-responsive {
                                width: max-content;
                                vertical-align: middle;
                                max-height: 65vh;
                            }

                            table {
                                /* text-align: left; */
                                position: relative;
                            }

                            th {
                                /* background: white; */
                                position: sticky;
                                top: 0;
                            }
                            </style>
                            <div class="tabsborderbg"></div>
                            <div class="box-body retrieve-data">
                                <div class="table-responsive">
                                    <table class="table table-hover"
                                        data-export-title="<?php echo lang('Word.opd_patient'); ?>"
                                        style="text-align: center">

                                    </table>
                                </div>
                            </div>
                            <?php
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div>




<?php $this->endSection() ?>


<?php $this->section('jsContent') ?>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>

<!-- <script src="<?php echo base_url(); ?>assets/js/pages/datatables.init.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    getDataAntrian()

});

const getDataAntrian = () => {
    getDataList('admin/antrian/getData', (res) => {
        if (res.respon === true) {
            renderTabelsAntrian(res?.value)
            window.globalDoctorData = res?.value.doctor
        } else {
            $("#bodydata-antrian").html(tempTablesNull())
        }
    }, (beforesend) => {
        getLoadingGlobalServices('bodydata-antrian')
        // $("#bodydata").html(loadingScreen())
    })

}

const renderTabelsAntrian = (data) => {
    let result = "";
    let isFirstLoketPendaftaran = true;

    data?.data?.forEach(item => {
        const isLoketPendaftaran = item.display_room.includes("LOKET PENDAFTARAN");

        const clinicOptions = data.poli.map(poli =>
            `<option value="${poli.clinic_id}" ${item?.clinic_id === poli.clinic_id ? 'selected' : ''} data-clinic-name="${poli.name_of_clinic}">
                ${poli.name_of_clinic}
            </option>`
        ).join('');

        const selectOptions = item?.clinic_id ?
            `<option value="${item.clinic_id}" selected>${data.poli.find(poli => poli.clinic_id === item.clinic_id)?.name_of_clinic}</option>` :
            `<option value="">Pilih</option>`;

        const filteredDoctors = data.doctor.filter(doc => doc.clinic_id === item?.clinic_id);

        const doctorOptions = filteredDoctors.map(doc =>
            `<option value="${doc.fullname}" data-employee-id="${doc.employee_id}" data-employee-code="${doc.employee_code}" ${item?.fullname === doc.fullname ? 'selected' : ''}>
                ${doc.fullname}
            </option>`
        ).join('');

        const disableClinicAndDoctor = isLoketPendaftaran;
        const disableDisplayIp = isLoketPendaftaran && !isFirstLoketPendaftaran;

        if (isLoketPendaftaran && isFirstLoketPendaftaran) isFirstLoketPendaftaran = false;

        result += `<tr>
                        <td>
                            <input type="hidden" name="display_id" value="${item.display_id}" />
                            ${item.display_room}
                        </td>
                        <td>
                            <select class="form-select" id="clinicSelect_${item?.clinic_id}" name="clinic_id" onchange="updateDoctors(this)" ${disableClinicAndDoctor ? 'disabled' : ''}>
                                ${selectOptions}
                                ${clinicOptions}
                            </select>
                            <input type="hidden" name="name_of_clinic" id="clinic_name_${item?.clinic_id}" value="${item.name_of_clinic ?? ''}" />
                        </td>
                        <td>
                            <input name="display_ip" id="display_ip_${item?.clinic_id}" class="form-control" value="${item.display_ip ?? ""}" ${disableDisplayIp ? 'readonly' : ''}>
                        </td>
                        <td>
                            <select class="form-select" id="doctorSelect_${item?.clinic_id}" onchange="updateDoctorName(this)" name="fullname" ${disableClinicAndDoctor ? 'disabled' : ''}>
                                <option value="">Pilih Dokter</option>
                                ${doctorOptions}
                            </select>
                            <input type="hidden" name="employee_id" id="employee_id_${item?.clinic_id}" value="${item.employee_id ?? ''}" />
                            <input type="hidden" name="employee_code" id="employee_code_${item?.clinic_id}" value="${item.employee_code ?? ''}" />
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm checkbox-toggle pull-right w-100 form2btn" ${disableDisplayIp ? 'disabled' : ''}>
                                <i class="fas fa-check"></i> Save
                            </button>
                        </td>
                    </tr>`;
    });

    $("#bodydata-antrian").html(result);
    setupForm2BtnListeners();
};




const updateDoctors = (selectElement) => {
    const selectedClinicId = selectElement.value;
    const row = $(selectElement).closest('tr');
    const doctorSelect = row.find(`[id^='doctorSelect_']`);

    const selectedClinicOption = $(selectElement).find('option:selected');
    const clinicName = selectedClinicOption.data('clinic-name');
    row.find(`input[name="name_of_clinic"]`).val(clinicName);

    doctorSelect.empty().append('<option value="">Pilih Dokter</option>');

    const doctors = window.globalDoctorData;
    const filteredDoctors = doctors?.filter(doc => doc.clinic_id === selectedClinicId);

    filteredDoctors.forEach(doc => {
        doctorSelect.append(
            `<option value="${doc.fullname}" data-employee-id="${doc.employee_id}" data-employee-code="${doc.employee_code}">${doc.fullname}</option>`
        );
    });
};

const updateDoctorName = (selectElement) => {
    const selectedOption = $(selectElement).find('option:selected');

    const employeeId = selectedOption.data('employee-id');
    const employeeCode = selectedOption.data('employee-code');

    const row = $(selectElement).closest('tr');

    row.find(`input[name="employee_id"]`).val(employeeId);
    row.find(`input[name="employee_code"]`).val(employeeCode);
};




const setupForm2BtnListeners = () => {
    $('.form2btn').off('click').on('click', function() {
        const row = $(this).closest('tr');
        const display_id = row.find('input[name="display_id"]').val();
        const clinic_id = row.find('select[name="clinic_id"]').val();
        const display_ip = row.find('input[name="display_ip"]').val();
        const fullname = row.find('select[name="fullname"]').val();
        const employee_id = row.find('input[name="employee_id"]').val();
        const employee_code = row.find('input[name="employee_code"]').val();
        const name_of_clinic = row.find('input[name="name_of_clinic"]').val();

        postData({
            display_id,
            clinic_id,
            display_ip,
            fullname,
            employee_id,
            employee_code,
            name_of_clinic
        }, 'admin/antrian/updateAntrian', (res) => {
            $('.form2btn').prop('disabled', false).html('<i class="fas fa-check"></i> Save');
            if (res?.respon === true) {
                successSwal(res?.message);
            } else {
                errorSwal(res?.message)
            }

        }, (beforesend) => {
            $('.form2btn').prop('disabled', true).html(
                '<i class="fas fa-spinner fa-spin"></i> Loading...');
        })

    });
}
</script>


<?php $this->endSection() ?>