<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                © <script>
                    document.write(new Date().getFullYear())
                </script> SIMRS <span class="d-none d-sm-inline-block"> - PT Exindo Information Technology.</span>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="changePasswordModal" role="dialog" aria-labelledby="changePasswordLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="changePasswordLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-4 pb-4">
                <form id="changePasswordForm" action="<?= site_url('user/changePassword') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <div class="input-group">
                            <input id="old_password" type="password" name="old_password"
                                class="form-control <?= session('errors.old_password') ? 'is-invalid' : '' ?>"
                                placeholder="Password Lama">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('old_password', this)"><i
                                    class="far fa-eye"></i></button>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.old_password') ?>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_password">Password Baru</label>
                        <div class="input-group">
                            <input id="new_password" type="password" name="new_password"
                                class="form-control <?= session('errors.new_password') ? 'is-invalid' : '' ?>"
                                placeholder="Password Baru">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('new_password', this)"><i
                                    class="far fa-eye"></i></button>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.new_password') ?>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input id="confirm_password" type="password" name="confirm_password"
                                class="form-control <?= session('errors.confirm_password') ? 'is-invalid' : '' ?>"
                                placeholder="Konfirmasi Password">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('confirm_password', this)"><i
                                    class="far fa-eye"></i></button>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.confirm_password') ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>