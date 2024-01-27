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
    $(document).ready(function(e) {
        // getListRequestRad(nomor, visit)
        initializeSearchTarif("searchTarifRad", 'P016');
    })
    $("#radTab").on("click", function() {
        getTreatResultList(nomor, visit)
        getListRequestRad(nomor, visit)
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

    function getTreatResultList(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getTreatResultList',
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
                mrJson = data


                mrJson.forEach((element, key) => {

                    $("#radBody").append($("<tr>")
                        .append($("<td>").append($("<p>").html(mrJson[key].date_of_diagnosa)))
                        .append($("<td>").html(mrJson[key].name_of_clinic))
                        .append($("<td>").append($("<p>").html(mrJson[key].anamnase)).append($("<p>").html(mrJson[key].pemeriksaan)).append($("<p>").html(mrJson[key].pemeriksaan_02)).append($("<p>").html(mrJson[key].pemeriksaan_03)).append($("<p>").html(mrJson[key].diagnosa_id + '-' + mrJson[key].diagnosa_desc)))
                        .append($("<td>").append($("<p>").html(mrJson[key].teraphy_desc)).append($("<p>").html(mrJson[key].instruction)))
                        .append($("<td>").html(mrJson[key].fullname))
                    )
                });
            },
            error: function() {

            }
        });
    }

    function getListRequestRad(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestRad',
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


                hasilLabJson = data

                $("#listRequestRad").html("")


                hasilLabJson.forEach((element, key) => {
                    console.log(element)
                    $("#listRequestRad").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Radiologi </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getRadOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
                });
            },
            error: function() {

            }
        });
    }

    function requestRad() {
        url = '<?php echo base_url(); ?>admin/rekammedis/radOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

        window.open(url, "_blank")
    }

    function addBillRad() {
        setTarif('P016', "searchTarifRad")
        $("#addBill").modal("show")
    }
</script>