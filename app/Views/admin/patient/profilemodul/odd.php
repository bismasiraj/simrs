<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<!-- <style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style> -->



<div class="tab-pane" id="odd" role="tabpanel">
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 border-r">
      <?php echo view('admin/patient/profilemodul/profilebiodata', [
        'visit' => $visit,
      ]);
      ?>
    </div><!--./col-lg-6-->
    <div class="col-lg-9 col-md-9 col-xs-12">
      <div class="accordion mt-4">
        <div class="panel-group" id="tableInfCon">
          <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14" style="display: flex; justify-content: space-between; align-items: center;">
            ODD
            <a href="<?= base_url() . '/admin/rm/lainnya/pengobatan/' . base64_encode(json_encode($visit)); ?>" target="_blank">
              <button type="button" class="btn btn-sm btn-secondary" id="cetak">Cetak</button></a>
          </h3>
          <form>
            <table class="table table-bordered table-hover table-centered" style="text-align: center" id="tablesOdd">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Nama Obat</th>
                  <th scope="col"></th>
                  <th scope="col">Tanggal Diberikan</th>
                  <th scope="col">Jumlah Resep</th>
                  <th scope="col">Jumlah Diberikan</th>
                  <th scope="col">Aturan Pakai</th>
                </tr>
              </thead>

              <tbody id="bodydataOdd" class="table-group-divider">
                <!-- Isi tabel disini -->
              </tbody>
            </table>
            <div>
              <button type="button" class="btn btn-sm btn-primary" id="save-tabelsOdd">Perbarui</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- Modal Create -->
<div class="modal fade modal-xl" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Informed Consent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <div class="modal-body">
        <form id="formDokument">
          <!-- <div id="content-hide" hidden>
            </div> -->
          <div>
            <label for="exampleDataList" class="col-form-label">Dokumen</label>
            <select class="form-select" id="parameter_id" name="parameter_id">
            </select>
          </div>
          <div id="content-param"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-create-modal">Keluar</button>
        <button type="button" class="btn btn-primary" id="btn-save-inf-modal">Simpan</button>
        <button type="button" class="btn btn-primary" id="btn-edit-inf-modal">Perbarui</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="notif-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title-notif"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="content-notif">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-notif">Save changes</button>
      </div>
    </div>
  </div>
</div>