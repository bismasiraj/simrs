<script type="text/javascript">
    var tableRanap = $("#tableSearchRanap").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    var tableKetersediaanTT = $("#ketersediaanTT").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })

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
        holdModal('historyRajalModal')
        getHistoryRajalPasien(id)
    }

    function nextFormRanap(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSinglePV',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data) {
                    skunj = data
                    holdModal('addRanapModal')
                    $("#historyRajalModal").modal('hide')
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").hide();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getBedInfo',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableKetersediaanTT.clear()
                if (data) {
                    console.log(data)
                    data.forEach((element, key) => {
                        tableKetersediaanTT.row.add(element).draw()
                    });
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").hide();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }
</script>