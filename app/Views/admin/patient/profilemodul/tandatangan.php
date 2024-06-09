<div class="modal fade" id="digitalSignModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div id="" class="modal-body pt0 pb0">
                <form id="digitalSignForm" action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="valid_date" id="signvalid_date">
                    <input type="hidden" name="valid_user" id="signvalid_user">
                    <input type="hidden" name="valid_pasien" id="signvalid_pasien">
                    <input type="hidden" name="tombolsave" id="signtombolsave">
                    <div class="form-group">
                        <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password"><?= lang('Auth.password') ?></label>
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>