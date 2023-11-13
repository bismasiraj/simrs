<script type="text/javascript">
    var tableRanap = $("#tableSearchRanap").DataTable()
    $("#form2").on('submit', (function(e) {

        e.preventDefault();
        $("#form2btn").html('<i class="spinner-border spinner-border-sm"></i>')
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
                tableRanap.clear().draw()
                data.data.forEach((element, key) => {
                    // stringcolumn += '<tr class="table tablecustom-light">';
                    // element.forEach((element1, key1) => {
                    //     stringcolumn += "<td>" + element1 + "</td>";
                    // });
                    // stringcolumn += '</tr>'

                    tableRanap.row.add(element).draw()
                });
                $("#form2btn").html('<i class="fa fa-search"></i> Cari')
            },
            error: function() {

            }
        });

    }));

    function addRanap(id) {
        holdModal('historyRajalModal');
        getHistoryRajalPasien(id)
    }
</script>