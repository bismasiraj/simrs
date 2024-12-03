<footer class="main-footer">
    &copy; <?php echo date('Y'); ?>
    <?php echo $this->customlib->getAppName(); ?>
</footer>
<div class="control-sidebar-bg"></div>
</div>
<script>
    $.widget.bridge('uibutton', $.ui.button);

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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Daftar script yang akan dimuat secara dinamis
        var scripts = [
            '<?php echo base_url(); ?>backend/toast-alert/toastr.js', // jQuery
            '<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js', // Bootstrap
            '<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/dist/js/raphael-min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/morris/morris.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/sparkline/jquery.sparkline.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/knob/jquery.knob.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/dist/js/app.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/js/jquery.scrolling-tabs.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/js/jquery.scrolling-tabs.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
            '<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js', // Bootstrap
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
</script>
<link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>"></script>
<script>
    $('.navlistscroll').scrollingTabs();
</script>
<!--nprogress-->
<script src="<?php echo base_url(); ?>backend/dist/js/nprogress.js"></script>
<!--file dropify-->
<script src="<?php echo base_url(); ?>backend/dist/js/dropify.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/demo.js"></script>
<!--print table-->
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jquery.dataTables.min-stu.par.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/ss.custom.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
<?php
$language      = $this->customlib->getLanguage();
$language_name = $language["short_code"];
if ($language_name != 'en') {
?>
    <script src="<?php echo base_url(); ?>backend/plugins/datepicker/locales/bootstrap-datepicker.<?php echo $language_name ?>.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/locale/<?php echo $language_name ?>.js"></script>
<?php } ?>
<script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($this->session->flashdata('success_msg')) {
        ?>
            successSwal("<?php echo $this->session->flashdata('success_msg'); ?>");
            <?php $this->session->unset_userdata('success_msg'); ?>
        <?php
        } else if ($this->session->flashdata('error_msg')) {
        ?>
            errorSwal("<?php echo $this->session->flashdata('error_msg'); ?>");
            <?php $this->session->unset_userdata('error_msg'); ?>
        <?php
        } else if ($this->session->flashdata('warning_msg')) {
        ?>
            infoMsg("<?php echo $this->session->flashdata('warning_msg'); ?>");
            <?php $this->session->unset_userdata('warning_msg'); ?>
        <?php
        } else if ($this->session->flashdata('info_msg')) {
        ?>
            warningMsg("<?php echo $this->session->flashdata('info_msg'); ?>");
            <?php $this->session->unset_userdata('info_msg'); ?>
        <?php
        }
        ?>
    });
</script>
<script type="text/javascript">
    function complete_event(id, status) {
        $.ajax({
            url: "<?php echo site_url("user/calendar/markcomplete/") ?>" + id,
            type: "POST",
            data: {
                id: id,
                active: status
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorSwal(message);
                } else {
                    successSwal(res.message);
                    window.location.reload(true);
                }
            }
        });
    }

    function markc(id) {
        $('#newcheck' + id).change(function() {
            if (this.checked) {
                complete_event(id, 'yes');
            } else {
                complete_event(id, 'no');
            }
        });
    }
</script>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="user_sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel">
    <form action="#" id="form_modal_usersession" class="form-horizontal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sessionModalLabel"><?php echo $this->lang->line('session'); ?></h4>
                </div>
                <div class="modal-body user_sessionmodal_body pb0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary submit_usersession" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait.."><?php echo $this->lang->line('save'); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function() {
        var datetime_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(true, true), ['d' => 'DD', 'm' => 'MM', 'Y' => 'YYYY', 'H' => 'hh', 'i' => 'mm']) ?>';
        $("body").delegate(".datetime", "focusin", function() {
            $(this).datetimepicker({
                format: datetime_format,
                locale: '<?php echo $language_name ?>',

            });
        });

        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $("body").delegate(".date", "focusin", function() {

            $(this).datepicker({
                todayHighlight: false,
                format: date_format,
                autoclose: true,
                language: '<?php echo $language_name ?>'
            });
        });
        var daterange_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'DD', 'm' => 'MM', 'Y' => 'YYYY']) ?>';
        $("body").delegate(".daterange", "focusin", function() {
            $(this).daterangepicker({
                locale: {
                    format: daterange_format,
                },

            });
        });
    });
</script>
<script type="text/javascript">
    $("body").on('click', '.cpicker', function() {
        var color = $(this).data('color');
        // Clicked on the same selected color
        if ($(this).hasClass('cpicker-big')) {
            return false;
        }

        $(this).parents('.cpicker-wrapper').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
        $(this).removeClass('cpicker-small', 'fast').addClass('cpicker-big', 'fast');
        if ($(this).hasClass('kanban-cpicker')) {
            $(this).parents('.panel-heading-bg').css('background', color);
            $(this).parents('.panel-heading-bg').css('border', '1px solid ' + color);
        } else if ($(this).hasClass('calendar-cpicker')) {
            $("body").find('input[name="eventcolor"]').val(color);
        }
    });
</script>
<?php
if (isset($ipdnpres_data) && (!empty($ipdnpres_data))) {
    if (isset($ipdnpres_data['ipdnpres_data']['patient_id'])) {
?>
        <script type="text/javascript">
            var datetime_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(true, true), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy', 'H' => 'hh', 'i' => 'mm']) ?>';

            var ipdnpres_data = '<?php echo json_encode($ipdnpres_data['ipdnpres_data']) ?>';
            var data = JSON.parse(ipdnpres_data);
            var patientid = data.patient_id;
            var ipdid = data.id;
            var presid = data.presid

            view_prescription(presid, ipdid, 'yes');
            // console.log(ipdid);
        </script>
    <?php } else {
    ?>
        <script type="text/javascript">
            var datetime_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(true, true), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy', 'H' => 'hh', 'i' => 'mm']) ?>';

            var ipdnpres_data = '<?php echo json_encode($ipdnpres_data['ipdnpres_data']) ?>';
            var data = JSON.parse(ipdnpres_data);
            var patientid = data.patient_id;
            var ipdid = data.id;
            var presid = data.presid
            view_prescription(presid, ipdid, 'yes')
        </script>
<?php }
}
?>