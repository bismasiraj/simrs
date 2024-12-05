<!doctype html>
<html lang="en">

<head>

    <?php echo view('layout/partials/title-meta.php', [
        'title' => $orgunit['NAME_OF_ORG_UNIT'],
    ]);
    ?>
    <?php echo view('layout/partials/head-css.php');
    ?>

</head>

<?php echo view('layout/partials/body.php'); ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php echo view('layout/partials/menu.php'); ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <?php echo view('layout/partials/page-title.php', [
                    'title' => 'dashboard',
                    'pagetitle' => 'dashboard',
                    'subtitle' => 'dashboard',
                ]);
                ?>
                <?php $this->renderSection('content'); ?>


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php echo view('layout/partials/footer.php'); ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?php echo view('layout/partials/right-sidebar.php'); ?>

<?php echo view('layout/partials/vendor-scripts.php'); ?>

<!-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Daftar script yang akan dimuat secara dinamis
        var scripts = [
            '<?php echo base_url(); ?>assets/libs/morris.js/morris.min.js',
            '<?php echo base_url(); ?>assets/libs/raphael/raphael.min.js',
            '<?php echo base_url(); ?>assets/js/pages/dashboard.init.js',
            '<?php echo base_url(); ?>assets/js/app.js',
        ];

        // Memuat beberapa script secara berurutan
        loadMultipleScripts(scripts, function() {
            console.log('Semua library telah dimuat!');

            // Setelah semua script dimuat, Anda bisa mulai menggunakan library tersebut
            $(document).ready(function() {
                console.log('jQuery telah dimuat, sekarang bisa digunakan!');

                // Gunakan axios untuk contoh penggunaan
                axios.get('https://jsonplaceholder.typicode.com/posts')
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log('Error:', error);
                    });
            });
        });
    });
</script> -->
<!--Morris Chart-->
<script src="<?php echo base_url(); ?>assets/libs/morris.js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/raphael/raphael.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/pages/dashboard.init.js"></script>

<script src="<?php echo base_url(); ?>assets/js/app.js"></script>

<?php $this->renderSection('jsContent'); ?>

</body>

</html>