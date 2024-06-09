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
    <!-- <link href="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
    <script src="<?php echo base_url(); ?>assets/libs/tinymce/tinymce.min.js"></script>



    <!-- Bootstrap-wysihtml5 CSS -->
    <style>
        body {
            font-weight: 400;
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
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script> -->

    <script src="<?php echo base_url(); ?>assets/js/pages/form-validation.init.js"></script>

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