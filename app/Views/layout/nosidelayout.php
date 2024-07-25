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
    <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
    <script src="<?php echo base_url(); ?>assets/libs/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.2/quill.snow.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.2/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <!-- Bootstrap-wysihtml5 CSS -->
    <style>
        body {
            font-weight: 400;
        }
    </style>
    <script>
        var formattedDate = moment().format('YYYY-MM-DDTHH:mm'); // Adjust format as needed
    </script>
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
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script> -->

    <script src="<?php echo base_url(); ?>assets/js/pages/form-validation.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- App js -->
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/default.js"></script>

    <script>
        var baseurl = "<?php echo base_url(); ?>";

        // $(document).ready(function() {
        //     $('#armstanding_order').wysihtml5();
        //     $('#arminstruction').wysihtml5();
        // });
    </script>
    <?php $this->renderSection('jsContent'); ?>
</body>

</html>