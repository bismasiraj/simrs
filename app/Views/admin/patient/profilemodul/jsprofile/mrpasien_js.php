<script type='text/javascript'>
    $("#mrpasienTab").on("click", function() {
        getMrPasien(nomor)
    })
</script>
<script type='text/javascript'>
    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getMrPasien(nomor) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getMrPasien',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                mrJson = data


                mrJson.forEach((element, key) => {

                    $("#mrBody").append($("<tr>")
                        .append($("<td>").append($("<p>").html(mrJson[key].date_of_diagnosa)))
                        .append($("<td>").html(mrJson[key].name_of_clinic))
                        .append($("<td>").append($("<p>").html("<b>S</b>: " + mrJson[key].anamnase)).append($("<p>").html("<b>O</b>: " + mrJson[key].pemeriksaan)).append($("<p>").html("<b>A</b>: " + mrJson[key].pemeriksaan_02)).append($("<p>").html("<b>P</b>: " + mrJson[key].pemeriksaan_03)).append($("<p>").html(mrJson[key].diagnosa_id + '-' + mrJson[key].diagnosa_desc)))
                        .append($("<td>").append($("<p>").html(mrJson[key].teraphy_desc)).append($("<p>").html(mrJson[key].instruction)))
                        .append($("<td>").html(mrJson[key].fullname))
                    )



                });
            },
            error: function() {

            }
        });
    }
</script>