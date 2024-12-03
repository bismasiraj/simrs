<script type='text/javascript'>
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    var nomor = '<?= $visit['no_registration']; ?>';
    var ke = '%'
    var mulai = '2023-08-01' //tidak terpakai
    var akhir = '2023-08-31' //tidak terpakai
    var lunas = '%'
    // var klinik = '<?= $visit['clinic_id']; ?>'
    var klinik = '%'
    var rj = '%'
    var status = '%'
    var nota = '%'
    var trans = '<?= $visit['trans_id']; ?>'
    var visit = '<?= $visit['visit_id']; ?>'
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