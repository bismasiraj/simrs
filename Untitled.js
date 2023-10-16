
$("#fillsuffer_type")
.append($("<option>")
    .attr('value', '0').html('Belum Diidentifikasi')
)
.append($("<option>")
    .attr('value', '1').html('KASUS BARU')
)
.append($("<option>")
    .attr('value', '2').html('KASUS LAMA')
)
.append($("<option>")
    .attr('value', '11').html('KASUS BEDAH')
)
.append($("<option>")
    .attr('value', '12').html('KASUS NON BEDAH')
)
.append($("<option>")
    .attr('value', '13').html('KASUS KEBIDANAN')
)
.append($("<option>")
    .attr('value', '14').html('KASUS PSKIATRIK')
)
.append($("<option>")
    .attr('value', '15').html('KASUS ANAK')
);
var diagIndex = 0;
$("#adddiagbtn").on("click", function() {
var diag_id = $("#filldiagnosa").val()
var diag_name = $("filldiagnosa").text()
var diag_cat = $("#filldiag_cat").val()
var diag_suffer = $("#fillsuffer_type").val()


})

function addRowDiag(diag_id, diag_name, diag_cat, diag_suffer) {
diagIndex++;
$("#bodyDiag")
    .append($('<tr>')
        .append($('<td>').html(diagIndex + "."))
        .append($('<td>')
            .append($('<input>').attr('name', 'ardiag_id').attr('value', diag_id).attr('type', 'text'))
        )
        .append($('<td>')
            .append($('<input>').attr('name', 'ardiag_name').attr('value', diag_name).attr('type', 'text'))
        )
        .append($('<td>')
            .append($("<select>")
                .attr('name', 'arsuffer_type')                             .append($("<option>")
                        .attr('value', '0').html('BELUM DIIDENTIFIKASI')
                    )                             .append($("<option>")
                        .attr('value', '1').html('KASUS BARU')
                    )                             .append($("<option>")
                        .attr('value', '2').html('KASUS LAMA')
                    )                             .append($("<option>")
                        .attr('value', '11').html('KASUS BEDAH')
                    )                             .append($("<option>")
                        .attr('value', '12').html('KASUS NON BEDAH')
                    )                             .append($("<option>")
                        .attr('value', '13').html('KASUS KEBIDANAN')
                    )                             .append($("<option>")
                        .attr('value', '14').html('KASUS PSKIATRIK')
                    )                             .append($("<option>")
                        .attr('value', '15').html('KASUS ANAK')
                    )                         .val(diag_suffer)
            )
        )
        .append($('<td>')
            .append($("<select>")
                .attr('name', 'ardiag_cat')                             .append($("<option>")
                        .attr('value', '1').html('DIAGNOSA UTAMA')
                    )                             .append($("<option>")
                        .attr('value', '2').html('DIAGNOSA PENUNJANG /SEKUNDER')
                    )                             .append($("<option>")
                        .attr('value', '3').html('DIAGNOSA MASUK')
                    )                             .append($("<option>")
                        .attr('value', '4').html('DIAGNOSA HARIAN/ KERJA')
                    )                             .append($("<option>")
                        .attr('value', '5').html('DIAGNOSA KECELAKAAN')
                    )                             .append($("<option>")
                        .attr('value', '6').html('DIAGNOSA KEMATIAN')
                    )                             .append($("<option>")
                        .attr('value', '7').html('DIAGNOSA BANDING')
                    )                             .append($("<option>")
                        .attr('value', '8').html('DIAGNOSA UTAMA EKLAIM')
                    )                             .append($("<option>")
                        .attr('value', '9').html('DIAGNOSA SEKUNDER EKLAIM')
                    )                         .val(diag_cat)
            )
        )
    )



}

$('#filldiagnosa').select2({
ajax: {
    url: 'http://localhost:8080/admin/patient/getDiagnosisListAjax',
    type: "post",
    dataType: 'json',
    delay: 250,
    data: function(params) {
        return {
            searchTerm: params.term // search term
        };
    },
    processResults: function(response) {
        return {
            results: response
        };
    },
    cache: true
}
});
