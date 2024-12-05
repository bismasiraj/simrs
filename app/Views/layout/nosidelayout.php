<!doctype html>
<html lang="en">

<head>

    <?php echo view('layout/partials/title-meta.php', [
        'title' => $orgunit['NAME_OF_ORG_UNIT'],
    ]);
    ?>
    <?php echo view('layout/partials/head-css.php');
    ?>
    <link href="<?php echo base_url(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.min.css">
    <!-- <link href="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
    <!-- <script src="<?php echo base_url(); ?>assets/libs/tinymce/tinymce.min.js"></script> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/quill/quill.snow.css" />
    <script src="<?php echo base_url(); ?>assets/libs/quill/quill.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/qrcode/qrcode.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

    <!-- Bootstrap-wysihtml5 CSS -->
    <style>
        body {
            font-weight: 400;
        }

        .custom-success-swal {
            background-color: #f8d7da;
            /* Your desired background color */
            color: #721c24;
            /* Text color for better contrast */
        }

        .qrcode-class {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            height: 100%;
            /* Ensure parent has height if needed */
        }
    </style>
</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php echo view('layout/partials/topbar.php'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="container-fluid">

                <?php echo view('layout/partials/page-title.php', [
                    'title' => 'dashboard',
                    'pagetitle' => 'dashboard',
                    'subtitle' => 'dashboard',
                ]);
                ?>


                <?php $this->renderSection('content'); ?>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php echo view('layout/partials/footer.php'); ?>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <?php echo view('layout/partials/vendor-scripts.php'); ?>
    <!-- Bootstrap-wysihtml5 JavaScript -->

    <script src="<?php echo base_url(); ?>assets/libs/select2/js/select2.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> -->

    <!-- <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script> -->

    <script src="<?php echo base_url(); ?>assets/js/pages/form-validation.init.js"></script>

    <script src="<?php echo base_url(); ?>assets/libs/sweetalert/sweetalert.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet"> -->
    <!-- App js -->
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/libs/moment/min/moment.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/libs/sweetalert/sweetalert.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/default.js"></script>

    <script>
        // Initialize Flatpickr
        flatpickr(".dateflatpickr", {
            enableTime: false,
            dateFormat: "d/m/Y"
        });

        $(".dateflatpickr").on("change", function() {
            console.log($(this).attr("id"))
            let theid = $(this).attr("id")
            theid = theid.replace("flat", "")
            let thevalue = $(this).val()
            let formattedDate = moment(thevalue, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm');
            $("#" + theid).val(formattedDate)
        })
        $(".dateflatpickr").prop("readonly", false)
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
        // $(".datetimeflatpickr").val(nowtime).trigger("change")
    </script>
    <script>
        var baseurl = "<?php echo base_url(); ?>";

        // $(window).on('storage', function(e) {
        //     if (e.originalEvent.storageArea === localStorage && e.originalEvent.key === 'refresh') {
        //         // Perform a refresh if the key 'refresh' was updated
        //         location.reload();
        //     }
        // });



        // $(document).ready(function() {
        //     $('#armstanding_order').wysihtml5();
        //     $('#arminstruction').wysihtml5();
        // });
    </script>
    <?php $this->renderSection('jsContent'); ?>
</body>

</html>