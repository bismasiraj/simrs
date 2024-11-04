<div class="tab-pane" role="tabpanel" id="suratketeranganlahir">
    <div class="row">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                ]); ?>
            </div>
            <div class="col-lg-9 col-md-9 col-xs-12">
                <div class="row">
                    <form class="row g-3" id="formSKL">
                        <input type="hidden" name="visit_id" value="<?= @$visit['visit_id']; ?>">
                        <input type="hidden" name="clinic_id" value="<?= @$visit['clinic_id']; ?>">
                        <input type="hidden" name="keluar_id" value="<?= @$visit['keluar_id']; ?>">
                        <input type="hidden" name="employee_id" value="<?= @$visit['employee_id']; ?>">
                        <input type="hidden" name="baby_id">
                        <input type="hidden" name="ageday" value="<?= @$visit['ageday']; ?>">
                        <input type="hidden" name="agemonth" value="<?= @$visit['agemonth']; ?>">
                        <input type="hidden" name="ageyear" value="<?= @$visit['ageyear']; ?>">
                        <input type="hidden" name="isrj" value="<?= @$visit['isrj']; ?>">
                        <input type="hidden" name="status_pasien_id" value="<?= @$visit['status_pasien_id']; ?>">
                        <input type="hidden" name="contact_address" value="<?= @$visit['contact_address']; ?>">
                        <input type="hidden" name="pasien_id" value="<?= @$visit['pasien_id']; ?>">
                        <input type="hidden" name="status_pasien_id" value="<?= @$visit['status_pasien_id']; ?>">
                        <input type="hidden" name="org_unit_code" value="<?= @$visit['org_unit_code']; ?>">
                        <input type="hidden" name="no_registration" value="<?= @$visit['no_registration']; ?>">
                        <input type="hidden" name="diagnosa_id" value="<?= @$visit['diagnosa']; ?>">
                        <input type="hidden" name="mothername" value="<?= @$visit['diantar_oleh']; ?>">
                        <input type="hidden" name="doctor" value="<?= @$visit['fullname']; ?>">
                        <input type="hidden" name="class_room_id" value="<?= @$visit['class_room_id']; ?>">
                        <input type="hidden" name="bed_id" value="<?= @$visit['bed_id']; ?>">

                        <div class="card py-3">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="col-2">Nama Pasien</td>
                                        <td class="col-4"><?= @$visit['diantar_oleh']; ?></td>
                                        <td class="col-2">Departemen</td>
                                        <td class="col-4"><?= @$visit['departement']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">ID (KTP)</td>
                                        <td class="col-4"></td>
                                        <td class="col-2">Dokter DPJP</td>
                                        <td class="col-4"><?= @$visit['fullname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Jenis Kelamin</td>
                                        <td class="col-4"><?= $visit['gender']; ?></td>
                                        <td class="col-2">Room</td>
                                        <td class="col-4"><?= @$visit['class_room_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Tanggal Lahir</td>
                                        <td class="col-4"><?= tanggal_indo(date_format(date_create($visit['date_of_birth']), 'Y-m-d')); ?></td>
                                        <td class="col-2">Bed</td>
                                        <td class="col-4"><?= @$visit['bed_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2">Usia Pasien</td>
                                        <td class="col-4"><?= @$visit['age']; ?></td>
                                        <td class="col-2">Kelas</td>
                                        <td class="col-4"><?= @$visit['class_id']; ?></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="inspection_date" class="form-label">Tanggal Lahir</label>
                                        <input type="datetime-local" class="form-control" id="inspection_date" name="inspection_date">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="thename" class="form-label">Nama Anak</label>
                                        <input type="text" class="form-control" id="thename" name="thename">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                        <select id="gender" class="form-select" name="gender">
                                            <option value="3">Lk & Pr</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="baby_birth" class="form-label">Kondisi Bayi</label>
                                        <select id="baby_birth" class="form-select" name="baby_birth">
                                            <option value="1">AKTIF & MENANGIS</option>
                                            <option value="2">LEMAH & MERINTIH</option>
                                            <option value="3">CACAT BAWAAN</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3 d-flex justify-content-end gap-2">
                                        <button type="reset" class="btn btn-outline-primary" id="btn-tutup-skl">Tutup</button>
                                        <button type="button" id="btn-save-skl" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="accordion mt-4">
                    <div class="panel-group" id="tableInfCon">
                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14 text-center">SURAT KETERANGAN LAHIR</h3>
                        <table class="table table-bordered table-hover table-centered" style="text-align: center">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Anak</th>
                                    <th scope="col">Bayi Ke</th>
                                    <th scope="col" width="1%"><span class="mdi mdi-lead-pencil"></span></th>
                                    <th scope="col" width="1%"><span class="mdi mdi-delete"></span></th>
                                    <th scope="col" width="1%"><span class="mdi mdi-printer"></span></th>
                                </tr>
                            </thead>
                            <tbody id="bodydataSKL" class="table-group-divider">

                                <tr>
                                    <td colspan="6">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('admin/patient/profilemodul/jsprofile/suratketeranganlahir_js', [
    'title' => 'Surat Keterangan Lahir',
    'visit' => $visit,
]); ?>