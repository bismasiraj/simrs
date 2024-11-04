<style>
    /* Modal overlay background */
    .sign-modal-backdrop {
        z-index: 1040;
        /* Ensure it is below the modal content */
    }

    /* Styling for the modal content */
    .sign-modal-content {
        border-radius: 8px;
        /* Rounded corners for the modal */
        background-color: #fff;
        /* White background for better readability */
        padding: 1rem;
        /* Add padding inside the modal */
    }

    /* Modal header styling */
    .sign-modal-header {
        border-bottom: 1px solid #dee2e6;
        /* Light border for separation */
        padding-bottom: 1rem;
        /* Add padding at the bottom of the header */
    }

    /* Modal body padding */
    .sign-modal-body {
        padding: 1.5rem;
        /* Increased padding for a more spacious look */
    }

    /* Add shadow to modal content */
    .sign-modal-content.shadow-lg {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for a 3D effect */
    }

    /* Form control styling */
    #digitalSignModal.form-control {
        border-radius: 0.25rem;
        /* Rounded corners for input fields */
        border-color: #ced4da;
        /* Light border color */
    }

    #digitalSignModal.form-control.is-invalid {
        border-color: #dc3545;
        /* Border color for invalid input */
    }

    #digitalSignModal.invalid-feedback {
        color: #dc3545;
        /* Color for invalid feedback text */
    }
</style>
<div class="modal fade" id="digitalSignModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content sign-modal-content rounded-4 shadow-lg">
            <div class="modal-header sign-modal-header">
                <h5 class="modal-title" id="myModalLabel">Digital Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--./modal-header-->
            <div class="modal-body sign-modal-body pt-4 pb-4">
                <form id="digitalSignForm" action="" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="valid_date" id="signvalid_date">
                    <input type="hidden" name="valid_user" id="signvalid_user">
                    <input type="hidden" name="valid_pasien" id="signvalid_pasien">
                    <input type="hidden" name="tombolsave" id="signtombolsave">
                    <input type="hidden" name="formId" id="signform">
                    <input type="hidden" name="container" id="signcontainer">
                    <input type="hidden" name="docs_type" id="signdocs_type"> <!-- tipe dokumen per modul, nanti mulai nya dari 7 -->
                    <input type="hidden" name="sign_id" id="signsign_id"> <!-- body id dari dokumen -->
                    <!-- <input type="hidden" name="user_type" id="signuser_type"> -->
                    <input type="hidden" name="sign_ke" id="signsign_ke"> <!-- statis 1 -->
                    <input type="hidden" name="title" id="signtitle"> <!-- Judul dokumen -->
                    <input type="hidden" name="sign_path" id="signsign_path">

                    <div class="col-12 mb-3">
                        <label for="signuser_type">Penandatangan</label>
                        <div class="form-group">
                            <select name='user_type' id="signuser_type" class="form-select" style="width:100%">
                                <option value="1">Tenaga Medis</option>
                                <option value="2">Pasien</option>
                                <option value="3">Wali Pasien</option>
                            </select>
                        </div>
                    </div>
                    <div id="signmedis">
                        <div id="displayuser_id" class="form-group">
                            <label for="user_id">Username</label>
                            <input id="user_id" type="text" class="form-control" name="user_id" placeholder="Username">
                        </div>
                        <div id="displaypassword" class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div id="displaysignname" class="form-group">
                            <label for="signname">Nama</label>
                            <input id="signname" type="text" class="form-control" name="name" placeholder="Nama Wali">
                        </div>
                        <div id="displaysignno_registration" class="form-group">
                            <label for="signno_registration">Nomor RM</label>
                            <input id="signno_registration" type="text" class="form-control" name="no_registration" placeholder="Nomor RM">
                        </div>
                        <div id="displaysigndatepasien" class="form-group">
                            <label for="signdatepasien">Tanggal Lahir (YYYYMMDD)</label>
                            <input id="signdatepasien" type="text" name="datebirth" class="form-control" placeholder="YYYYMMDD">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="digitalSignModalOperation" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Digital Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--./modal-header-->
            <div class="modal-body pt-4 pb-4">
                <form id="digitalSignFormDocs" action="" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="valid_date" id="signopsvalid_date">
                    <input type="hidden" name="valid_user" id="signopsvalid_user">
                    <input type="hidden" name="valid_pasien" id="signopsvalid_pasien">
                    <input type="hidden" name="tombolsave" id="signopstombolsave">
                    <input type="hidden" name="formId" id="signopsform">
                    <input type="hidden" name="container" id="signopscontainer">
                    <input type="hidden" name="docs_type" id="signopsdocs_type">
                    <!-- tipe dokumen per modul, nanti mulai nya dari 7 -->
                    <input type="hidden" name="sign_id" id="signopssign_id"> <!-- body id dari dokumen -->
                    <input type="hidden" name="user_type" id="signopsuser_type"> <!-- urut dari 1 dst -->
                    <input type="hidden" name="sign_ke" id="signopssign_ke"> <!-- statis 1 -->
                    <input type="hidden" name="title" id="signopstitle"> <!-- Judul dokumen -->
                    <input type="hidden" name="sign_path" id="signopssign_path">
                    <div class="form-group">
                        <label for="user_id">Username</label>
                        <input id="user_idops" type="text" class="form-control">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="passwordops" type="password" name="password" class="form-control">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="digitalSignModalGizi" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title">Digital Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--./modal-header-->
            <div class="modal-body pt-4 pb-4">
                <form id="digitalSignFormGizi" action="" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="valid_date" id="signgizivalid_date">
                    <input type="hidden" name="valid_user" id="signgizivalid_user">
                    <input type="hidden" name="valid_pasien" id="signgizivalid_pasien">
                    <input type="hidden" name="tombolsave" id="signgizitombolsave">
                    <input type="hidden" name="formId" id="signgiziform">
                    <input type="hidden" name="container" id="signgizicontainer">
                    <input type="hidden" name="docs_type" id="signgizidocs_type">
                    <!-- tipe dokumen per modul, nanti mulai nya dari 7 -->
                    <input type="hidden" name="sign_id" id="signgizisign_id"> <!-- body id dari dokumen -->
                    <input type="hidden" name="user_type" id="signgiziuser_type"> <!-- urut dari 1 dst -->
                    <input type="hidden" name="sign_ke" id="signgizisign_ke"> <!-- statis 1 -->
                    <input type="hidden" name="title" id="signgizititle"> <!-- Judul dokumen -->
                    <input type="hidden" name="sign_path" id="signgizisign_path">
                    <div class="form-group">
                        <label for="user_id">Username</label>
                        <input id="user_idgizi" type="text" class="form-control">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="passwordgizi" type="password" name="password" class="form-control">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>