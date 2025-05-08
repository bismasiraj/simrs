<div class="modal fade" id="historyEresepModal" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-media-content">

            <div class="modal-header modal-media-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <h4>History Obat Pasien</h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div><!--./row-->
                </div>
            </div><!--./modal-header-->
            <form id="s" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                <div class="pup-scroll-area">

                    <div class="modal-body pb0 ptt10" style="overflow-y:visible;">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="accordion">
                                        <div class="panel-group" id="historyEresep">
                                        </div>
                                    </div>
                                </div>
                            </div><!--./box-footer-->
                        </div>
                        <div></div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div><!--./row-->
            </form>
        </div>

    </div><!--./modal-body-->
</div>

<script type="text/javascript">
    function fillHistoryEresep(resep, keyvisit) {
        addRowObat(null, resep.resep_ke, resep, keyvisit)

        $("#body" + keyvisit).find("input, textarea, select").prop("disabled", true)
    }
</script>