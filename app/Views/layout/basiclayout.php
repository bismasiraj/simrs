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
    <link href="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

</head>

<body data-sidebar="dark">

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
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/pages/form-validation.init.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script>
        var baseurl = "<?php echo base_url(); ?>";
    </script>
    <?php $this->renderSection('jsContent'); ?>
</body>

</html>