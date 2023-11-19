<?php
$this->extend('layout/basiclayout', [
    'title' => $title
]) ?>
<?php
$rajalTipe = [1, 2, 0, 73, 50, 5];
$ranapTipe = [1, 3, 2, 0, 73, 50, 5];
$permissions = user()->getPermissions();

?>
<?php $this->section('topbar') ?>
<?php echo view('layout/partials/topbar.php', [
    'title' => $title,
    'pagetitle' => 'dashboard',
    'subtitle' => 'dashboard',
]); ?>
<?php $this->endSection() ?>
<?php $this->section('content') ?>
<?php
$currency_symbol = 'Rp. ';
?>
<style>
    .table-centered>tbody>tr>th {
        vertical-align: middle;
    }

    .table-centered>tbody>tr>td {
        text-align: center;
    }

    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php if ($giTipe == 0) { ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#biodata" type="button" role="tab" aria-controls="biodata" aria-selected="true"><i class="fa fa-th text-primary"></i> Biodata Pasien</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#rawat_jalan" type="button" role="tab" aria-controls="rawat_jalan" aria-selected="true"><i class="fa fa-stethoscope text-primary"></i> Rawat Jalan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#rawat_inap" type="button" role="tab" aria-controls="rawat_inap" aria-selected="true"><i class="fa fa-procedures text-primary"></i> Rawat Inap</button>
                                    </li>
                                <?php } ?>
                                <?php if (in_array($giTipe, $rajalTipe)  && $giTipe != 0) { ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#rawat_jalan" type="button" role="tab" aria-controls="rawat_jalan" aria-selected="true"><i class="fa fa-stethoscope text-primary"></i> Rawat Jalan</button>
                                    </li>
                                    <!-- <li><a href="#rawat_inap" data-toggle="tab" aria-expanded="true"><i class="far fa-procedures"></i> Rawat Inap</a></li> -->
                                <?php } ?>
                                <?php if ($giTipe == 3) { ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#rawat_inap" type="button" role="tab" aria-controls="rawat_inap" aria-selected="true"><i class="fa fa-procedures text-primary"></i> Rawat Inap</button>
                                    </li>
                                <?php } ?>
                                <?php if (in_array($giTipe, $ranapTipe) && $giTipe != 3  && $giTipe != 0) { ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#rawat_inap" type="button" role="tab" aria-controls="rawat_inap" aria-selected="true"><i class="fa fa-procedures text-primary"></i> Rawat Inap</button>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="tab-content">
                                <?php
                                if ($giTipe == 0) {
                                    echo view('admin/patient/modul/search_pasien', [
                                        'giTipe' => $giTipe,
                                        // 'search_text' => $search_text,
                                        'orgunit' => $orgunit,
                                        'img_time' => $img_time,
                                        'coverage' => $coverage,
                                        'status' => $status,
                                        'jenis' => $jenis,
                                        'kelas' => $kelas,
                                        'kalurahan' => $kalurahan,
                                        'kecamatan' => $kecamatan,
                                        'kota' => $kota,
                                        'prov' => $prov,
                                        'statusPasien' => $statusPasien,
                                        'payor' => $payor,
                                        'education' => $education,
                                        'marital' => $marital,
                                        'agama' => $agama,
                                        'job' => $job,
                                        'blood' => $blood,
                                        'family' => $family,
                                        'gender' => $gender
                                    ]);
                                }
                                ?>

                                <?php if (in_array($giTipe, $rajalTipe)) {
                                    echo view('admin/patient/modul/search_rajal', [
                                        'giTipe' => $giTipe,
                                        'rajalTipe' => $rajalTipe,
                                        'title' => '',
                                        'orgunit' => $orgunit,
                                        'img_time' => $img_time,
                                        'clinic' => $clinic,
                                        'dokter' => $dokter,
                                        'coverage' => $coverage,
                                        'status' => $status,
                                        'jenis' => $jenis,
                                        'kelas' => $kelas,
                                        'kalurahan' => $kalurahan,
                                        'kecamatan' => $kecamatan,
                                        'kota' => $kota,
                                        'prov' => $prov,
                                        'statusPasien' => $statusPasien,
                                        'payor' => $payor,
                                        'education' => $education,
                                        'marital' => $marital,
                                        'agama' => $agama,
                                        'job' => $job,
                                        'blood' => $blood,
                                        'family' => $family,
                                        'gender' => $gender,
                                        'way' => $way,
                                        'reason' => $reason,
                                        'isattended' => $isattended,
                                        'inasisPoli' => $inasisPoli,
                                        'inasisFaskes' => $inasisFaskes,
                                        // 'diagnosa' => $diagnosa,
                                        'dpjp' => $dpjp
                                    ]);
                                }
                                ?>
                                <?php
                                // if ($giTipe == 3 || $giTipe == 2 || $giTipe == 0 || $giTipe == 73 || $giTipe == 50 || $giTipe == 5) {
                                if (in_array($giTipe, $ranapTipe)) {
                                    // if (in_array($giTipe, $ranapTipe)) {
                                    echo view('admin/patient/modul/search_ranap', [
                                        'giTipe' => $giTipe,
                                        'ranapTipe' => $ranapTipe,
                                        // 'gsPoli' => $gsPoli,
                                        'title' => '',
                                        'orgunit' => $orgunit,
                                        'img_time' => $img_time,
                                        'clinic' => $clinic,
                                        'dokter' => $dokter,
                                        'coverage' => $coverage,
                                        'status' => $status,
                                        'jenis' => $jenis,
                                        'kelas' => $kelas,
                                        'kalurahan' => $kalurahan,
                                        'kecamatan' => $kecamatan,
                                        'kota' => $kota,
                                        'prov' => $prov,
                                        'statusPasien' => $statusPasien,
                                        'payor' => $payor,
                                        'education' => $education,
                                        'marital' => $marital,
                                        'agama' => $agama,
                                        'job' => $job,
                                        'blood' => $blood,
                                        'family' => $family,
                                        'gender' => $gender,
                                        'way' => $way,
                                        'reason' => $reason,
                                        'isattended' => $isattended,
                                        'inasisPoli' => $inasisPoli,
                                        'inasisFaskes' => $inasisFaskes,
                                        // 'diagnosa' => $diagnosa,
                                        'dpjp' => $dpjp,
                                        'caraKeluar' => $caraKeluar,
                                        'clinicInap' => $clinicInap
                                    ]);
                                } ?>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
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
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
    var coverage = status = jenis = kelas = kalurahan = kecamatan = kota = prov = statusPasien = payor = education = marital = agama = job = blood = gender = family = new Array();
    var skunj = new Array();
    var dpjp = new Array();

    gender = [
        <?php foreach ($gender as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $gender[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    <?php foreach ($coverage as $key => $value) { ?>
        coverage[<?= $coverage[$key]['coverage_id']; ?>] = '<?= $coverage[$key]['coveragetype']; ?>';
    <?php } ?>
    <?php foreach ($status as $key => $value) { ?>
        status[<?= $status[$key]['status_peserta_kode']; ?>] = '<?= $status[$key]['status_peserta']; ?>';
    <?php } ?>
    <?php foreach ($jenis as $key => $value) { ?>
        jenis[<?= $jenis[$key]['kdjnspeserta']; ?>] = '<?= $jenis[$key]['nmjnspeserta']; ?>';
    <?php } ?>
    kelas = [
        <?php foreach ($kelas as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kelas[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kalurahan = [
        <?php foreach ($kalurahan as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kalurahan[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kecamatan = [
        <?php foreach ($kecamatan as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kecamatan[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kota = [
        <?php foreach ($kota as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kota[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    prov = [
        <?php foreach ($prov as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $prov[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    statusPasien = [
        <?php foreach ($statusPasien as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $statusPasien[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    payor = [
        <?php foreach ($payor as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $payor[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    agama = [
        <?php foreach ($agama as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $agama[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    marital = [
        <?php foreach ($marital as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $marital[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    blood = [
        <?php foreach ($blood as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $blood[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    job = [
        <?php foreach ($job as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $job[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    education = [
        <?php foreach ($education as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $education[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    family = [
        <?php foreach ($family as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $family[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    <?php foreach ($dpjp as $key => $value) { ?>
        dpjp['<?= $key; ?>'] = '<?= $value; ?>';
    <?php } ?>
</script>
<script type="text/javascript">
    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function getAge(dateString) {
        var now = new Date();
        var today = new Date(now.getYear(), now.getMonth(), now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();

        var dob = new Date(dateString.substring(0, 4),
            dateString.substring(5, 7) - 1,
            dateString.substring(8, 10)
        );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";


        yearAge = yearNow - yearDob;

        if (monthNow >= monthDob)
            var monthAge = monthNow - monthDob;
        else {
            yearAge--;
            var monthAge = 12 + monthNow - monthDob;
        }

        if (dateNow >= dateDob)
            var dateAge = dateNow - dateDob;
        else {
            monthAge--;
            var dateAge = 31 + dateNow - dateDob;

            if (monthAge < 0) {
                monthAge = 11;
                yearAge--;
            }
        }

        age = {
            years: yearAge,
            months: monthAge,
            days: dateAge
        };

        if (age.years > 1) yearString = " years";
        else yearString = " year";
        if (age.months > 1) monthString = " months";
        else monthString = " month";
        if (age.days > 1) dayString = " days";
        else dayString = " day";

        return age;
    }


    function get_date() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }
</script>
<script type="text/javascript">
    var dokterdpjp = new Array();
    var skunj = new Array();

    <?php
    foreach ($dokter as $key => $value) {
        foreach ($value as $key1 => $value1) {
    ?>
            dokterdpjp.push(['<?= $key; ?>', '<?= $key1; ?>', '<?= $value1; ?>']);
    <?php
        }
    }
    ?>

    $("#klinik").on("change", function() {
        $("#dokter").html("");
        var clinicSelected = $("#klinik").val();
        $("#dokter").append(new Option('Semua', '%'));
        dokterdpjp.forEach((value, key) => {
            if (value[0] == clinicSelected) {
                $("#dokter").append(new Option(value[2], value[1]));
            }
        })
    });




    function resetModal() {
        // $("#patientDetails").hide();
        $('#patientDetails').find('td').each(function() {
            var patientDataId = $(this).attr('id');
            if (!(typeof patientDataId == "undefined")) {
                $("#" + patientDataId).html("")
            }

        });
        $('#formaddpv').find('input').each(function() {
            var patientDataId = $(this).attr('id');
            if (!(typeof patientDataId == "undefined")) {
                $("#" + patientDataId).val("")
            }

        });
        $('#formaddpv').find('select').each(function() {
            var patientDataId = $(this).attr('id');
            if (!(typeof patientDataId == "undefined")) {
                $("#" + patientDataId).prop('selectedIndex', 0);
                $("#" + patientDataId).val("")
            }

        });

        $("#kdpoli_eks").val(0)
        $("#isnew").val(0)
        $("#cob").val(0)
        $("#way_id").val(17)
        $("#way_id").val(17)
        $("#isattended").val(0)

        // $("#formaddpvbtn").prop("disabled", "disabled")
        // $("#formaddpvbtn_save_print").prop("disabled", "disabled")
    }
</script>
<script type="text/javascript">
    function get_PatientDetails(id) {
        var base_url = "<?php echo base_url(); ?>backend/images/loading.gif";
        $("#ajax_load").html("<center><img src='" + base_url + "'/>");
        if (id == '') {
            $("#ajax_load").html("");
            $("#patientDetails").hide();
        } else {
            $.ajax({
                url: baseurl + 'admin/patient/getpatientDetails',
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $("#ajax_load").html("");
                        $("#patientDetails").show();
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


                        $("#pvdiantar_oleh").val(skunj.name_of_pasien);
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

                        $("#formaddpvbtn").removeProp("disabled")
                        $("#formaddpvbtn_save_print").removeProp("disabled")


                        $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
                    } else {
                        $("#ajax_load").html("");
                        $("#patientDetails").hide();
                    }

                    // holdModal('myModal');
                    // patientvisit(data.no_registration);
                },
            });
        }

    }
</script>

<?php
if ($giTipe == 0) {
    echo view('admin/patient/modul/search_pasien_js', [
        'giTipe' => $giTipe,
        // 'search_text' => $search_text,
        'orgunit' => $orgunit,
        'img_time' => $img_time,
        'coverage' => $coverage,
        'status' => $status,
        'jenis' => $jenis,
        'kelas' => $kelas,
        'kalurahan' => $kalurahan,
        'kecamatan' => $kecamatan,
        'kota' => $kota,
        'prov' => $prov,
        'statusPasien' => $statusPasien,
        'payor' => $payor,
        'education' => $education,
        'marital' => $marital,
        'agama' => $agama,
        'job' => $job,
        'blood' => $blood,
        'family' => $family,
        'gender' => $gender
    ]);
}
?>
<?php if (in_array($giTipe, $rajalTipe)) {
    echo view('admin/patient/modul/search_rajal_js', [
        'giTipe' => $giTipe,
        'rajalTipe' => $rajalTipe,
        'title' => '',
        'orgunit' => $orgunit,
        'img_time' => $img_time,
        'clinic' => $clinic,
        'dokter' => $dokter,
        'coverage' => $coverage,
        'status' => $status,
        'jenis' => $jenis,
        'kelas' => $kelas,
        'kalurahan' => $kalurahan,
        'kecamatan' => $kecamatan,
        'kota' => $kota,
        'prov' => $prov,
        'statusPasien' => $statusPasien,
        'payor' => $payor,
        'education' => $education,
        'marital' => $marital,
        'agama' => $agama,
        'job' => $job,
        'blood' => $blood,
        'family' => $family,
        'gender' => $gender,
        'way' => $way,
        'reason' => $reason,
        'isattended' => $isattended,
        'inasisPoli' => $inasisPoli,
        'inasisFaskes' => $inasisFaskes,
        // 'diagnosa' => $diagnosa,
        'dpjp' => $dpjp
    ]);
}
?>
<?php
// if ($giTipe == 3 || $giTipe == 2 || $giTipe == 0 || $giTipe == 73 || $giTipe == 50 || $giTipe == 5) {
if (in_array($giTipe, $ranapTipe)) {
    // if (in_array($giTipe, $ranapTipe)) {
    echo view('admin/patient/modul/search_ranap_js', [
        'giTipe' => $giTipe,
        'ranapTipe' => $ranapTipe,
        // 'gsPoli' => $gsPoli,
        'title' => '',
        'orgunit' => $orgunit,
        'img_time' => $img_time,
        'clinic' => $clinic,
        'dokter' => $dokter,
        'coverage' => $coverage,
        'status' => $status,
        'jenis' => $jenis,
        'kelas' => $kelas,
        'kalurahan' => $kalurahan,
        'kecamatan' => $kecamatan,
        'kota' => $kota,
        'prov' => $prov,
        'statusPasien' => $statusPasien,
        'payor' => $payor,
        'education' => $education,
        'marital' => $marital,
        'agama' => $agama,
        'job' => $job,
        'blood' => $blood,
        'family' => $family,
        'gender' => $gender,
        'way' => $way,
        'reason' => $reason,
        'isattended' => $isattended,
        'inasisPoli' => $inasisPoli,
        'inasisFaskes' => $inasisFaskes,
        // 'diagnosa' => $diagnosa,
        'dpjp' => $dpjp,
        'caraKeluar' => $caraKeluar,
    ]);
} ?>
</div>

<?php $this->endSection() ?>