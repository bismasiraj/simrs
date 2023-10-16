<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    <?php
    // $titleresult = $this->customlib->getTitleName();
    if (!empty(lang('Auth.loginTitle'))) {
        $title_name = lang('Auth.loginTitle');
    } else {
        $title_name = "Hospital Name Title";
    }
    ?>
    <title><?php echo $title_name; ?></title>
    <!--favican-->
    <link href="<?php echo base_url(); ?>uploads/hospital_content/logo/rsudMYunus.ico" rel="shortcut icon" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.mCustomScrollbar.min.css">
    <style type="text/css">
        .col-md-offset-3 {
            margin-left: 29%;
        }

        .loginbg {
            background: #8ea9ca;
            max-height: 480px;
            box-shadow: 0 10px 18px 0 rgba(62, 57, 107, 0.2);
            border-radius: 4px;
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
                        <div class="loginbg">

                            <div class="form-bottom">
                                <h3 class="font-white bolds"><?= lang('Auth.admin_login'); ?></h3>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form action="<?= url_to('login') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <input type="text" name="login" placeholder="<?php echo lang('Auth.username'); ?>" value="" class="form-username form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="email">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" value="" name="password" placeholder="<?php echo lang('Auth.password'); ?>" class="form-password form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn"><?php echo lang('Auth.sign_in'); ?></button>
                                </form>
                                <br>
                                <?php if ($config->activeResetter) : ?>
                                    <p><a href="<?php echo site_url('site/forgotpassword') ?>" class="forgot"><i class="fa fa-key"></i> <?php echo lang('Auth.forgot_password'); ?>?</a> </p>
                                <?php endif; ?>
                                <?php if ($config->allowRemembering) : ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                            <?= lang('Auth.rememberMe') ?>
                                        </label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!$empty_notice) {
                    ?>
                        <div class="col-lg-1 col-sm-1">
                            <div class="separatline"></div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-sm-6">
                            <div class="loginright form-box  mCustomScrollbar">
                                <div class="messages">
                                    <h3><?php echo lang('Auth.what_is_new_in'); ?> <?php echo $sch_name; ?></h3>
                                    <?php
                                    foreach ($notice as $notice_key => $notice_value) {
                                    ?>
                                        <h4><?php echo $notice_value['title']; ?></h4>
                                        <?php
                                        $string = ($notice_value['description']);
                                        $string = strip_tags($string);
                                        if (strlen($string) > 100) {
                                            // truncate string
                                            $stringCut = substr($string, 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a class=more href="' . site_url('read/' . $notice_value['slug']) . '">Read More</a>';
                                        }
                                        echo '<p>' . $string . '</p>';
                                        ?>
                                        <div class="logdivider"></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!--./col-lg-6-->
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $.backstretch([
            base_url + "/assets/img/backgrounds/RSUDWATES.png"
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