<!doctype html>
<html lang="en">

<head>

    <?php
    echo view('layout/partials/title-meta.php', [
        'title' => $orgunit['NAME_OF_ORG_UNIT'],
    ]);
    ?>
    <?php echo view('layout/partials/head-css.php');
    ?>
    <link href="<?php echo base_url(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.min.css">


</head>

<body class="">
    <style>

    </style>
    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php $this->renderSection('topbar'); ?>
        <?php echo view('layout/partials/sidebar.php'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php echo view('layout/partials/page-title.php');
                    ?>

                    <?php $this->renderSection('content'); ?>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <?php echo view('layout/partials/vendor-scripts.php'); ?>
    <script src="<?php echo base_url(); ?>assets/libs/select2/js/select2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/pages/form-validation.init.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/moment/min/moment.min.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/default.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/libs/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
    <script>
        // Initialize Flatpickr



        $(".dateflatpickr").each(function() {
            const flatid = $(this).attr("id");
            const initial = moment().format("DD/MM/YYYY");
            flatpickrInstances[flatid] = flatpickr("#" + flatid, {
                enableTime: false,
                dateFormat: "d/m/Y", // Display format
            });
        })
        // flatpickr(".dateflatpickr", {
        //     enableTime: true,
        //     dateFormat: "d/m/Y H:i", // Display format
        //     defaultDate: nowtime,
        //     time_24hr: true, // 24-hour time format
        //     minuteIncrement: 1
        // });
        $(".dateflatpickr").prop("readonly", false)
        $(".dateflatpickr").on("change", function() {
            console.log($(this).attr("id"))
            let theid = $(this).attr("id")
            theid = theid.replace("flat", "")
            let thevalue = $(this).val()
            let formattedDate = moment(thevalue, 'DD/MM/YYYY').format('YYYY-MM-DD');
            $("#" + theid).val(formattedDate)
        })
        $(".dateflatpickr").val(nowdate).trigger("change")




        $(".datetimeflatpickr").each(function() {
            const flatid = $(this).attr("id");
            const initial = moment().format("DD/MM/YYYY HH:mm");
            flatpickrInstances[flatid] = flatpickr("#" + flatid, {
                enableTime: true,
                dateFormat: "d/m/Y H:i", // Display format
                defaultDate: nowtime,
                time_24hr: true, // 24-hour time format
                minuteIncrement: 1
            });
        })
        // flatpickr(".datetimeflatpickr", {
        //     enableTime: true,
        //     dateFormat: "d/m/Y H:i", // Display format
        //     defaultDate: nowtime,
        //     time_24hr: true, // 24-hour time format
        //     minuteIncrement: 1
        // });
        $(".datetimeflatpickr").prop("readonly", false)
        $(".datetimeflatpickr").on("change", function() {
            console.log($(this).attr("id"))
            let theid = $(this).attr("id")
            theid = theid.replace("flat", "")
            let thevalue = $(this).val()
            let formattedDate = moment(thevalue, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm');
            $("#" + theid).val(formattedDate)
        })
    </script>
    <?php $this->renderSection('jsContent'); ?>
</body>

</html>