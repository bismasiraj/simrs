<!-- JAVASCRIPT -->
<!-- <script>
    // Fungsi untuk memuat script secara dinamis
    function loadScript(src, callback) {
        var script = document.createElement('script');
        script.src = src;
        script.onload = callback;
        document.head.appendChild(script);
    }

    // Fungsi untuk memuat beberapa script secara berurutan
    function loadMultipleScripts(scripts, finalCallback) {
        var index = 0;

        function loadNextScript() {
            if (index < scripts.length) {
                loadScript(scripts[index], function() {
                    index++;
                    loadNextScript(); // Panggil fungsi ini untuk memuat script berikutnya
                });
            } else {
                finalCallback(); // Semua script telah dimuat
            }
        }

        loadNextScript(); // Mulai memuat script pertama
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Daftar script yang akan dimuat secara dinamis
        var scripts = [
            '<?php echo base_url(); ?>assets/js/jquery.min.js', // jQuery
            '<?php echo base_url(); ?>assets/libs/metismenu/metisMenu.min.js', // Bootstrap
            '<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js', // Bootstrap
            '<?php echo base_url(); ?>assets/libs/node-waves/waves.min.js', // Bootstrap
            '<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js', // Bootstrap
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
<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/quill/quill.snow.css" />
<script src="<?php echo base_url(); ?>assets/libs/quill/quill.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.min.css">
<script src="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/moment/min/moment.min.js"></script>