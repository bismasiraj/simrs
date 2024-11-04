<?php
$session = session();
$gsPoli = $session->gsPoli;
$permissions = user()->getPermissions();
// dd(isset($permissions['pendaftaranrajal']['c']));
?>
<script type="text/javascript">
    var tableRajal = $("#tableSearchOperasi").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    $(document).ready(function(e) {
        <?php if ($gsPoli != '') { ?>
            $("#klinikrajal").val('<?= $gsPoli; ?>')
        <?php } ?>
        $("#formsearchoperasibtn").trigger('click')
    })
    $("#formsearchoperasi").on('submit', (function(e) {
        e.preventDefault();
        $("#formsearchoperasibtn").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getoperationdatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableRajal.clear().draw()
                data.data.forEach((element, key) => {
                    // stringcolumn += '<tr class="table tablecustom-light">';
                    // element.forEach((element1, key1) => {
                    //     stringcolumn += "<td>" + element1 + "</td>";
                    // });
                    // stringcolumn += '</tr>'
                    tableRajal.row.add(element).draw()
                });
                $("#formsearchoperasibtn").html('<i class="fa fa-search"></i> Cari')
            },
            error: function() {
                errorSwal('Data terlalu besar, silahkan persempit range tanggal atau ubah filter menjadi lebih spesifik')
                $("#formsearchoperasibtn").html('<i class="fa fa-search"></i>')
            }
        });

    }));
</script>