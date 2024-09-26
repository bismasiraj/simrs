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

<body class="vertical-collpsed">
    <style>
        /* Ensure the input background is white */
        .dateflatpickr {
            background-color: white;
            /* Set background color to white */
        }

        /* If needed, override additional Flatpickr styles */
        .flatpickr-calendar {
            background-color: white;
            /* Set the calendar background color if needed */
        }

        .flatpickr-day {
            color: black;
            /* Ensure text is readable on a white background */
        }

        .flatpickr-time {
            background-color: white;
            /* Set the time picker background color */
        }
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
        flatpickr(".dateflatpickr", {
            enableTime: false,
            dateFormat: "d/m/Y"
        });
        $(".dateflatpickr").on("change", function() {
            console.log($(this).attr("id"))
            let theid = $(this).attr("id")
            let thevalue = $(this).val()
            let formattedDate = moment(thevalue, 'DD/MM/YYYY').format('YYYY-MM-DD');
            $("input[name='" + theid + "']").val(formattedDate)
        })
        $(".dateflatpickr").prop("readonly", false)
        const now = moment().format('DD/MM/YYYY')
        $(".dateflatpickr").val(now).trigger("change")



        flatpickr(".datetimeflatpickr", {
            enableTime: true,
            dateFormat: "d/m/Y H:i", // Display format
            time_24hr: true, // 24-hour time format
        });
        $(".datetimeflatpickr").on("change", function() {
            console.log($(this).attr("id"))
            let theid = $(this).attr("id")
            let thevalue = $(this).val()
            let formattedDate = moment(thevalue, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm');
            $("input[name='" + theid + "']").val(formattedDate)
        })
        $(".datetimeflatpickr").val(now)
    </script>
    <?php $this->renderSection('jsContent'); ?>
</body>

</html>