<script type="text/javascript">
    $("#form2").on('submit', (function(e) {

        e.preventDefault();
        $("#form2btn").button('loading');
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getipddatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#bodydata2").html("");
                var stringcolumn = '';
                data.data.forEach((element, key) => {
                    stringcolumn += '<tr class="table tablecustom-light">';
                    element.forEach((element1, key1) => {
                        stringcolumn += "<td>" + element1 + "</td>";
                    });
                    stringcolumn += '</tr>'

                });
                $("#bodydata2").html(stringcolumn);
                $("#form2btn").button('reset');
            },
            error: function() {

            }
        });

    }));
</script>