<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    $(document).ready(function(e) {
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

    })
</script>
<script type='text/javascript'>
    function formatCurrency(total) {
        //Seperates the components of the number
        var components = total.toFixed(2).toString().split(".");
        //Comma-fies the first part
        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        //Combines the two sections
        return components.join(",");
    }


    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getHasilLab(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getHasilLab',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {


                hasilLabJson = data.result
                var headerKey = data.headerKey

                $("#labBody").html(headerKey)


                hasilLabJson.forEach((element, key) => {
                    $("#viewlab" + hasilLabJson[key].periksa_tgl).append($("<tr>")
                        .append($("<td>").append($("<p>").html(hasilLabJson[key].parameter_name)))
                        .append($("<td>").html(hasilLabJson[key].hasil))
                        .append($("<td>").html(hasilLabJson[key].satuan))
                        .append($("<td>").html(hasilLabJson[key].nilai_rujukan))
                        .append($("<td>").html(hasilLabJson[key].description))
                    )
                });
            },
            error: function() {

            }
        });
    }

    function requestLab() {
        url = '<?php echo base_url(); ?>admin/rekammedis/labOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

        window.open(url, "_blank")
    }
</script>