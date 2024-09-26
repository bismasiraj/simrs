<style>
    /* Modal overlay background */
    .modal-backdrop {
        z-index: 1040;
        /* Ensure it is below the modal content */
    }

    /* Styling for the modal content */
    .modal-content {
        border-radius: 8px;
        /* Rounded corners for the modal */
        background-color: #fff;
        /* White background for better readability */
        padding: 1rem;
        /* Add padding inside the modal */
    }

    /* Modal header styling */
    .modal-header {
        border-bottom: 1px solid #dee2e6;
        /* Light border for separation */
        padding-bottom: 1rem;
        /* Add padding at the bottom of the header */
    }

    /* Modal body padding */
    .modal-body {
        padding: 1.5rem;
        /* Increased padding for a more spacious look */
    }

    /* Add shadow to modal content */
    .modal-content.shadow-lg {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for a 3D effect */
    }

    /* Form control styling */
    .form-control {
        border-radius: 0.25rem;
        /* Rounded corners for input fields */
        border-color: #ced4da;
        /* Light border color */
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        /* Border color for invalid input */
    }

    .invalid-feedback {
        color: #dc3545;
        /* Color for invalid feedback text */
    }
</style>
<div class="modal fade" id="digitalSignModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Digital Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--./modal-header-->
            <div class="modal-body pt-4 pb-4">
                <form id="digitalSignForm" action="" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="valid_date" id="signvalid_date">
                    <input type="hidden" name="valid_user" id="signvalid_user">
                    <input type="hidden" name="valid_pasien" id="signvalid_pasien">
                    <input type="hidden" name="tombolsave" id="signtombolsave">
                    <input type="hidden" name="formId" id="signform">
                    <input type="hidden" name="container" id="signcontainer">
                    <input type="hidden" name="docs_type" id="signdocs_type">
                    <input type="hidden" name="sign_id" id="signsign_id">
                    <input type="hidden" name="user_type" id="signuser_type">
                    <input type="hidden" name="sign_ke" id="signsign_ke">
                    <input type="hidden" name="title" id="signtitle">
                    <input type="hidden" name="sign_path" id="signsign_path">
                    <div class="form-group">
                        <label for="user_id"><?= lang('Auth.emailOrUsername') ?></label>
                        <input id="user_id" type="text" class="form-control <?= session('errors.login') ? 'is-invalid' : '' ?>" name="user_id" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password"><?= lang('Auth.password') ?></label>
                        <input id="password" type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="<?= lang('Auth.password') ?>">
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