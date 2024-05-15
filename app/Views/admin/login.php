<!DOCTYPE html>
<html lang="id">

<head>
    <?php
    // $titleresult = $this->customlib->getTitleName();
    if (!empty(lang('Auth.loginTitle'))) {
        $title_name = lang('Auth.loginTitle');
    } else {
        $title_name = "Hospital Name Title";
    }
    ?>
    <title><?php echo $title_name; ?></title>
    <?php echo view('layout/partials/head-css.php');
    ?>
    <style type="text/css">
        .col-md-offset-3 {
            margin-left: 29%;
        }

        .loginbg {
            background: rgb(14 131 136);
            max-height: 480px;
            box-shadow: 0 10px 18px 0 rgba(62, 57, 107, 0.2);
            border-radius: 4px;
            color: #fff;
        }

        a.forgot {
            padding-top: 0px;
        }

        a.forgot {
            padding-top: 0px;
            color: #b0de37;
        }

        a:hover.forgot {
            padding-top: 0px;
            color: #fff;
            text-decoration: underline;
        }

        button.btn {
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #333;
            border: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            text-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -ms-transition: all .3s;
            transition: all .3s;
        }

        button.btn:hover {
            opacity: 100 !important;
            color: #fff;
            background: #fbc02d;
        }

        @media (max-width: 767px) {
            .col-md-offset-3 {
                margin-left: 0;
            }
        }

        .inner-bg {
            padding: 350px 0 100px 0;
        }
    </style>
</head>

<body>
    <!-- Top content -->
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <?php
                    $empty_notice = 0;
                    $offset = "";
                    // if (empty($notice)) {
                    if (empty($notice)) {

                        $empty_notice = 1;
                        $offset = "col-md-offset-3";
                        $offset = "";
                    }
                    ?>
                    <div class="col-lg-5 col-sm-5 form-box <?php echo $offset; ?>">
                        <div class="row">
                            <div class="card loginbg">
                                <div class="card-body pt-0">
                                    <div class="p-3">
                                        <!-- <h4 class="text-muted font-size-18 mb-1 text-center">Selamat Datang</h4>
                                        <p class="text-muted text-center">Silahkan login untuk melanjutkan ke aplikasi SIMRS</p> -->
                                        <form class="form-horizontal mt-4" action="<?= url_to('login') ?>" method="post">
                                            <?= csrf_field() ?>
                                            <?php if (session('errors.password')) { ?>
                                                <?php dd(session('errors')) ?>
                                            <?php } ?>
                                            <div class="mb-3">
                                                <label for="username">
                                                    <h4>Username</h4>
                                                </label>
                                                <input type="text" name="login" placeholder="<?php echo lang('Auth.username'); ?>" value="" class="form-username form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="userpassword">
                                                    <h4>Password</h4>
                                                </label>
                                                <input type="password" value="" name="password" placeholder="<?php echo lang('Auth.password'); ?>" class="form-password form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" autocomplete="off">
                                            </div>
                                            <div class="mb-3 row mt-4">
                                                <?php if ($config->allowRemembering) : ?>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                                            <label class="form-check-label" for="customControlInline">
                                                                <?= lang('Auth.rememberMe') ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="col-6 text-end">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit"><?php echo lang('Auth.sign_in'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <?php echo view('layout/partials/vendor-scripts.php'); ?>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $.backstretch([
            base_url + "/assets/img/backgrounds/RSMY-COVER-web.png"
        ], {
            duration: 3000,
            fade: 750
        });
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function(e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function refreshCaptcha() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha) {
                $("#captcha_image").html(captcha);
            }
        });
    }
</script>