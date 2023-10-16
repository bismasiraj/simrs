$('#fillitemid').select2({
    ajax: {
        url: '<?= base_url(); ?>admin/patient/getObatListAjax',
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