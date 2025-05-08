<!DOCTYPE html>
<html>
<?php

use App\Controllers\Admin\Patient;
use App\Controllers\BaseController;

$basecontroller = new Patient();
$basecontroller->checkMenuActive('register');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $orgunit['NAME_OF_ORG_UNIT']; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="theme-color" content="#5190fd" />
    <?php
    $mini_logo = base_url() . "uploads/hospital_content/logo/rsudMYunus.ico";
    ?>
    <link href="<?php echo $mini_logo; ?>" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css">
    <?php
    $theme = 'default';

    if ($theme == "default") {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/default/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/default/ss-main.css">
    <?php
    } elseif ($theme == "red") {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/red/skins/skin-red.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/red/ss-main-red.css">
    <?php
    } elseif ($theme == "blue") {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/blue/skins/skin-darkblue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/blue/ss-main-darkblue.css">
    <?php
    } elseif ($theme == "gray") {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/gray/skins/skin-light.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/themes/gray/ss-main-light.css">
    <?php
    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/all.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
    <!--file dropify-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/dropify.min.css">
    <!--file nprogress-->
    <link href="<?php echo base_url(); ?>backend/dist/css/nprogress.css" rel="stylesheet">
    <!--print table-->
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!--print table mobile support-->
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/moment/min/moment.min.js"></script>

    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/backend/dist/css/bootstrap-select.min.css">

    <?php $this->renderSection('cssContent'); ?>
</head>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>















<body class="hold-transition skin-blue fixed sidebar-mini">
    <script type="text/javascript">
        function collapseSidebar() {
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                sessionStorage.setItem('sidebar-toggle-collapsed', '');
            } else {
                sessionStorage.setItem('sidebar-toggle-collapsed', '1');
            }
        }

        function checksidebar() {
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                var body = document.getElementsByTagName('body')[0];
                body.className = body.className + ' sidebar-collapse';
            }
        }
        checksidebar();

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
    <?php
    $logo_image = base_url() . "assets/img/backgrounds/RSMY-HEADER.png";
    $mini_logo = base_url() . "assets/img/backgrounds/headerweb2.png";
    // $logoresult = $this->customlib->getLogoImage();
    // if (!empty($logoresult["image"])) {
    //     $logo_image = base_url() . "uploads/hospital_content/logo/" . $logoresult["image"];
    // } else {
    //     $logo_image = base_url() . "uploads/hospital_content/logo/s_logo.png";
    // }
    // if (!empty($logoresult["mini_logo"])) {
    //     $mini_logo = base_url() . "uploads/hospital_content/logo/" . $logoresult["mini_logo"];
    // } else {
    //     $mini_logo = base_url() . "uploads/hospital_content/logo/smalllogo.png";
    // }
    ?>
    <div class="wrapper">
        <header class="main-header" id="alert">
            <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">
                <span class="logo-mini"><img width="31" height="19" src="<?php echo $mini_logo . "?" . $img_time; ?>" alt="<?php echo $orgunit['NAME_OF_ORG_UNIT']; ?>" /></span>
                <span class="logo-mini"><?php echo $orgunit['NAME_OF_ORG_UNIT']; ?></span>
                <span class="logo-lg"><img src="<?php echo $logo_image; ?>" alt="<?php echo $orgunit['NAME_OF_ORG_UNIT']; ?>" /></span>
                <span class="logo-lg"><?php echo $orgunit['NAME_OF_ORG_UNIT']; ?></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" onclick="collapseSidebar()" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
                    <span href="#" class="sidebar-session">
                        <?php echo user()->getFullname(); ?>
                    </span>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-9">
                    <div class="pull-right">
                        <!-- <form class="navbar-form navbar-left search-form" role="search" action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                            <?php csrf_field(); ?>
                            <div class="input-group" style="padding-top:3px;">
                                <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="Nama / No RM">
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form> -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav headertopmenu">
                                <li class="cal15">

                                    <a href="<?php echo base_url() . "admin/systemnotification" ?>">
                                        <i class="fa fa-bell-o"></i>
                                        <?php

                                        // echo ($systemnotifications->count > 0) ? "<span class='label label-warning'>" . $systemnotifications->count . "</span>" : "";

                                        ?>
                                    </a>
                                </li>
                                <!-- <li class="">
                                    <a data-target="modal" href="#" id='beddata' data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading" onclick="getbedstatus()">
                                        <i class="fas fa-bed cal15"></i>
                                        <span class="spanDM"><?php echo lang('Word.bed_status'); ?></span>
                                    </a>
                                </li> -->
                                <li class="cal15">
                                    <a data-placement="bottom" data-toggle="tooltip" title="" href="<?php echo site_url('admin/chat') ?>" data-original-title="<?php echo lang('Word.chat'); ?>" class="todoicon"><i class="fa fa-whatsapp"></i> </a>
                                </li>

                                <?php
                                $file   = "";
                                $result = user();

                                $image = $result->user_image;
                                // $role  = $result["user_type"];
                                $id    = $result->id;
                                if (!empty($image)) {

                                    $file = "uploads/staff_images/" . $image;
                                } else {

                                    $file = "uploads/staff_images/no_image.png";
                                }
                                ?>
                                <li class="dropdown user-menu">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user menuboxshadow">
                                        <li>
                                            <div class="sstopuser">
                                                <div class="ssuserleft">
                                                    <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>"><img src="<?php echo base_url() . $file . $img_time; ?>" alt="User Image"></a>
                                                </div>

                                                <div class="sstopuser-test">
                                                    <h4 style="text-transform: capitalize;"><?php echo $result->username; ?></h4>
                                                    <h5><?php //echo $role; 
                                                        ?></h5>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="sspass">
                                                    <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo lang('Word.my_profile'); ?>"><i class="fa fa-user"></i><?php echo lang('Word.profile'); ?></a>
                                                    <a class="pl25" href="<?php echo base_url(); ?>admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="<?php echo lang('Word.change_password') ?>"><i class="fa fa-key"></i><?php echo lang('Word.password'); ?></a> <a class="pull-right" href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out fa-fw"></i><?php echo lang('Word.logout'); ?></a>
                                                </div>
                                            </div><!--./sstopuser-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <script>
            function defoult(id) {
                var defoult = $('#languageSwitcher').val();
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/language/defoult_language/" + id,
                    data: {},
                    success: function(data) {
                        successSwal("<?php echo lang('Word.status_change_successfully'); ?>");
                        $('#languageSwitcher').html(data);

                    }
                });

                window.location.reload('true');
            }

            function set_languages(lang_id) {
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/language/user_language/" + lang_id,
                    data: {},
                    success: function(data) {
                        successSwal("<?php echo lang('Word.status_change_successfully'); ?>");
                        window.location.reload('true');

                    }
                });
            }
        </script>
        <aside class="main-sidebar" id="alert2">
            <section class="sidebar" id="sibe-box">
                <ul class="sessionul fixedmenu" style="display: none;">
                    <li class="dropdown">
                        <a class="dropdown-toggle drop5" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span></span> <i class="glyphicon glyphicon-th pull-right"></i>
                        </a>
                        <ul class="dropdown-menu verticalmenu" style="min-width:194px;font-size:10pt;left:3px;">
                            <?php //if ($this->rbac->hasPrivilege('student', 'can_view')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>student/search"><i class="fa fa-user-plus"></i><?php echo lang('student_details'); ?></a></li>
                            <?php //} 
                            ?>
                            <?php //if ($this->rbac->hasPrivilege('income', 'can_add')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/income"> &nbsp;<i class="fa fa-usd"></i> <?php echo lang('Word.add_income'); ?></a></li>
                            <?php //} 
                            ?>
                            <?php //if ($this->rbac->hasPrivilege('expense', 'can_view')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-credit-card"></i><?php echo lang('Word.add_expense'); ?></a></li>
                            <?php //} 
                            ?>

                            <?php //if ($this->rbac->hasPrivilege('staff_attendance', 'can_view')) {
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/staffattendance"><i class="fa fa-calendar-check-o"></i><?php echo lang('Word.staff_attendance'); ?></a></li>
                            <?php //}
                            //if ($this->rbac->hasPrivilege('staff', 'can_view')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/staff"><i class="fa fa-calendar-check-o"></i><?php echo lang('Word.staff_directory'); ?></a></li>
                            <?php
                            //}
                            ?>
                            <?php //if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/enquiry"><i class="fa fa-calendar-check-o"></i><?php echo lang('admission_enquiry'); ?></a></li>
                            <?php
                            //}
                            //if ($this->rbac->hasPrivilege('complaint', 'can_view')) {
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/complaint"><i class="fa fa-calendar-check-o"></i><?php echo lang('Word.complain'); ?></a></li>
                            <?php //}
                            //if ($this->rbac->hasPrivilege('upload_content', 'can_view')) { 
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/content"><i class="fa fa-download"></i><?php echo lang('Word.upload_content'); ?></a></li>
                            <?php
                            //}
                            //if ($this->rbac->hasPrivilege('item_stock', 'can_add')) {
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/itemstock"><i class="fa fa-object-group"></i><?php echo lang('Word.add_item_stock'); ?></a></li>
                            <?php
                            //}
                            //if ($this->rbac->hasPrivilege('notice_board', 'can_view')) {
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-bullhorn"></i><?php echo lang('Word.notice_board'); ?></a></li>
                            <?php
                            //}
                            //if ($this->rbac->hasPrivilege('email_sms', 'can_view')) {
                            ?>
                            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/mailsms/compose"><i class="fa fa-envelope-o"></i><?php echo lang('send_email_/_sms'); ?></a></li>
                            <?php //} 
                            ?>
                        </ul>
                    </li>
                </ul>
                <ul class="sidebar-menu verttop">
                    <li class="treeview <?= $basecontroller->checkMenuActive('dashboard'); ?> <?= $basecontroller->checkMenuActive(''); ?>">
                        <a href="<?php echo base_url(); ?>admin/admin/dashboard">
                            <i class="fas fa-television"></i> <span> Dashboard</span>
                        </a>
                    </li>
                    <?php //dd(user()->checkRoles(['superuser', 'admin','billingpasien']));
                    if (user()->checkRoles(['superuser', 'admin', 'billingpasien'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('bill'); ?>">
                            <a href="<?php echo site_url('admin/patient/bill'); ?>">
                                <i class="fas fa-file-invoice"></i> <span> <?php echo lang('Word.billing'); ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpendaftaran'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('search'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/search">
                                <i class="fa fa-calendar-check-o"></i> <span><?php echo "Pendaftaran"; ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'dokter', 'perawat'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('rajal'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/rajal">
                                <i class="fas fa-stethoscope"></i> <span> Pelayanan</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'customerservices', 'perawat', 'operatorbangsal', 'bangsal', 'dokter'])) { ?>
                        <li class="treeview ranap">
                            <a href="<?php echo base_url() ?>admin/patient/ranap">
                                <i class="fas fa-procedures" aria-hidden="true"></i> <span> <?php echo lang('Word.ipd_in_patient'); ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpelayananobat'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('farmasi'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/farmasi">
                                <i class="fas fa-mortar-pestle"></i> <span> <?php echo lang('Word.pharmacy'); ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('laboratorium'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/laboratorium">
                                <i class="fas fa-flask"></i> <span><?php echo "Laboratorium"; ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('radiologi'); ?>">

                            <a href="<?php echo base_url() ?>admin/patient/radiologi">
                                <i class="fas fa-microscope"></i> <span><?php echo lang('Word.radiology'); ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'billingpasien'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('hemodialisa'); ?>">
                            <a href="<?php echo base_url() ?>admin/patient/hemodialisa">
                                <i class="fas fa-tint"></i> <span><?php echo "Haemodialisa"; ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'operatorugd'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('unitgawatdarurat'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/unitgawatdarurat">
                                <i class="fas fa-ambulance" aria-hidden="true"></i>
                                <span> <?php echo "Unit Gawat Darurat"; ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('kamaroperasi'); ?>">
                            <a href="<?php echo base_url(); ?>admin/patient/kamaroperasi">
                                <i class="fas fa-dungeon"></i> <span><?php echo "Kamar Operasi"; ?></span>
                            </a>
                        </li>

                    <?php } ?>
                    <div class="col-md-12">
                        <div class="dividerhr"></div>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-line-chart" style="margin-right: 12px;"></i><span>Laporan</span></p>
                    </div>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'dokter'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('fo'); ?>">
                            <a href="#">
                                <span>Front Office</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('foantrol'); ?>"><a href="<?php echo base_url(); ?>admin/report/foantrol"><i class="fas fa-angle-right"></i>Antrian Online</a>
                                <li class="<?= $basecontroller->checkMenuActive('foantrol'); ?>"><a href="<?php echo base_url(); ?>admin/report/satusehat"><i class="fas fa-angle-right"></i>Satu Sehat</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('registermasuk'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermasuk"><i class="fas fa-angle-right"></i> Register Masuk Ranap</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('registerkeluar'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerkeluar"><i class="fas fa-angle-right"></i> Register Keluar Ranap</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('registerpindah'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpindah"><i class="fas fa-angle-right"></i> Register Pindah Ranap</li>
                                <li class="<?= $basecontroller->checkMenuActive('registermelahirkan'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermelahirkan"><i class="fas fa-angle-right"></i> Register Pasien Melahirkan</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'dokter'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('register'); ?>">
                            <a href="#">
                                <span>Register</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('registerpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpoli"><i class="fas fa-angle-right"></i>Register Rawat Jalan</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('registermasuk'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermasuk"><i class="fas fa-angle-right"></i> Register Masuk Ranap</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('registerkeluar'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerkeluar"><i class="fas fa-angle-right"></i> Register Keluar Ranap</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('registerpindah'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpindah"><i class="fas fa-angle-right"></i> Register Pindah Ranap</li>
                                <li class="<?= $basecontroller->checkMenuActive('registermelahirkan'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermelahirkan"><i class="fas fa-angle-right"></i> Register Pasien Melahirkan</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'dokter'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('rm'); ?>">
                            <a href="#">
                                <span>Rekam Medis</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjungan'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjungan"><i class="fas fa-angle-right"></i>Kunjungan Rumah Sakit</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjunganranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganranap"><i class="fas fa-angle-right"></i> Kunjungan Rawat Inap</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjunganranapstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganranapstatus"><i class="fas fa-angle-right"></i> Kunjungan Rawat Inap <p>Per Jenis Pelayanan</p></a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjunganklinik'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganklinik"><i class="fas fa-angle-right"></i> Kunjungan Rawat Jalan <br>Per Klinik</li>
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjunganstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganstatus"><i class="fas fa-angle-right"></i> Kunjungan Rawat Jalan <br>Per Status</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmkunjunganugd'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganugd"><i class="fas fa-angle-right"></i> Kunjungan Rawat Jalan <br>Per Status</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmtopxrajal'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxrajal"><i class="fas fa-angle-right"></i> Top X Diagnosa <br>Rawat Jalan</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmtopxranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxranap"><i class="fas fa-angle-right"></i> Top X Diagnosa <br>Rawat Inap</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmtopxugd'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxugd"><i class="fas fa-angle-right"></i> Top X Diagnosa <br>Unit Gawat Darurat</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmindexrajal'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmindexrajal"><i class="fas fa-angle-right"></i> Kartu Index Penyakit Rajal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('rmindexranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmindexranap"><i class="fas fa-angle-right"></i> Kartu Index Penyakit Ranap</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('fin'); ?>">
                            <a href="#">
                                <span>Keuangan</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('finharian'); ?>"><a href="<?php echo base_url(); ?>admin/report/finharian"><i class="fas fa-angle-right"></i>Keuangan Harian</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('finbulanan'); ?>"><a href="<?php echo base_url(); ?>admin/report/finbulanan"><i class="fas fa-angle-right"></i> Keuangan Bulanan</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('fintglpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/fintglpoli"><i class="fas fa-angle-right"></i> Keuangan Tanggal Poli</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpolitgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpolitgl"><i class="fas fa-angle-right"></i> Keuangan Poli Tanggal</li>
                                <li class="<?= $basecontroller->checkMenuActive('finrajalstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/finrajalstatus"><i class="fas fa-angle-right"></i> Kunjungan Rawat Jalan <br>Per Status</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpoli"><i class="fas fa-angle-right"></i> Keuangan Poli Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finjenis'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenis"><i class="fas fa-angle-right"></i> Keuangan Per Jenis</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finjenistgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenistgl"><i class="fas fa-angle-right"></i> Keuangan Jenis Tanggal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finjenisrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenisrinci"><i class="fas fa-angle-right"></i> Transaksi Keuangan Jenis Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantgl"><i class="fas fa-angle-right"></i> Transaksi Pembayaran/Tanggal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantrx'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantrx"><i class="fas fa-angle-right"></i> Transaksi Pembayaran/TRX</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayaranrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayaranrinci"><i class="fas fa-angle-right"></i> Transaksi Pembayaran Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetor'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetor"><i class="fas fa-angle-right"></i> Rekap Penerimaan dan <p>Setoran Kasir</p></a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetorrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetorrinci"><i class="fas fa-angle-right"></i> Penerimaan dan <p>Setoran Kasir Rinci</p></a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpelayananobat'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('apt'); ?>">
                            <a href="#">
                                <span>Apotek</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('aptrekapnota'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekapnota"><i class="fas fa-angle-right"></i>Rekap Nota Obat</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('aptrekapobat'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekapobat"><i class="fas fa-angle-right"></i> Rekap Pemakaian Obat</a>
                                </li>
                                <li class="<?= $basecontroller->checkMenuActive('aptrekappelayanan'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekappelayanan"><i class="fas fa-angle-right"></i> Rekap Pelayanan</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('aptobatalkes'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptobatalkes"><i class="fas fa-angle-right"></i> Pemakaian Obat / Alkes</li>
                                <li class="<?= $basecontroller->checkMenuActive('aptpsikotropika'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptpsikotropika"><i class="fas fa-angle-right"></i> Laporan Psikotropika</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('aptrekappsikotropika'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekappsikotropika"><i class="fas fa-angle-right"></i> Rekap Psikotropika</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('aptpembelian'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptpembelian"><i class="fas fa-angle-right"></i> Pembelian per Tanggal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('aptkartubarang'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptkartubarang"><i class="fas fa-angle-right"></i> Kartu Barang</a></li>
                                <!-- <li class="<?= $basecontroller->checkMenuActive('finjenisrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenisrinci"><i class="fas fa-angle-right"></i> Transaksi Keuangan Jenis Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantgl"><i class="fas fa-angle-right"></i> Transaksi Pembayaran/Tanggal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantrx'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantrx"><i class="fas fa-angle-right"></i> Transaksi Pembayaran/TRX</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayaranrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayaranrinci"><i class="fas fa-angle-right"></i> Transaksi Pembayaran Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetor'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetor"><i class="fas fa-angle-right"></i> Rekap Penerimaan dan <p>Setoran Kasir</p></a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetorrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetorrinci"><i class="fas fa-angle-right"></i> Penerimaan dan <p>Setoran Kasir Rinci</p></a></li> -->
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpelayananobat'])) { ?>
                        <li class="treeview <?= $basecontroller->checkMenuActive('admin'); ?>">
                            <a href="#">
                                <span>Log</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?>"><a href="<?php echo base_url(); ?>admin/report/adminlog"><i class="fas fa-angle-right"></i>Log User</a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </section>
        </aside>

        <?php $this->renderSection('content'); ?>


        <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
        <footer class="main-footer">
            &copy; <?php echo date('Y'); ?>
            <?php echo user()->username; ?>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <!--language js-->
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.languageselectpicker').selectpicker();
        });
    </script>
    <script src="<?php echo base_url(); ?>backend/js/jquery.scrolling-tabs.js"></script>
    <script>
        $('.navlistscroll').scrollingTabs();
    </script>
    <script type="text/javascript">
        $("#myModalpa").on('hidden.bs.modal', function(e) {
            console.log("sdfsdfsf");
            $(".filestyle").next(".dropify-clear").trigger("click");

            $('form#formaddpa').find('input:text, input:password, input:file, textarea').val('');
            $('form#formaddpa').find('select option:selected').removeAttr('selected');
            $('form#formaddpa').find('input:checkbox, input:radio').removeAttr('checked');
        });
        $(document).ready(function() {
            $(".studentsidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('.studentsideclose, .overlay').on('click', function() {
                $('.studentsidebar').removeClass('active');
                $('.overlay').fadeOut();
            });

            $('#sidebarCollapse').on('click', function() {
                $('.studentsidebar').addClass('active');
                $('.overlay').fadeIn();
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <script src="<?php echo base_url(); ?>backend/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
    <?php
    $language      = 'Indonesia';
    $language_name = 'id';

    if ($language_name != 'en') {
    ?>
        <script src="<?php echo base_url(); ?>backend/plugins/datepicker/locales/bootstrap-datepicker.<?php echo $language_name ?>.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/locale/<?php echo $language_name ?>.js"></script>

    <?php } ?>
    <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/default.js"></script>
    <!-- nprogress -->
    <script src="<?php echo base_url(); ?>backend/dist/js/nprogress.js"></script>
    <!-- file dropify -->
    <script src="<?php echo base_url(); ?>backend/dist/js/dropify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.buttons.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jszip.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/pdfmake.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/vfs_fonts.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/ss.custom.js"></script>
    <script src="<?php echo base_url(); ?>backend/dist/datatables/js/datetime-moment.js"></script>
    <script src="<?php echo base_url() ?>backend/plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dt-body-right a").tooltip();
        });
    </script>

</body>

</html>
<!-- jQuery 3 -->


















<script src="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>backend/fullcalendar/dist/locale-all.js"></script>

<?php if ($language_name != 'en') { ?>
    <script src="<?php echo base_url() ?>backend/fullcalendar/dist/locale/<?php echo $language_name ?>.js"></script>
<?php } ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
    function complete_event(id, status) {
        $.ajax({
            url: "<?php echo site_url("admin/calendar/markcomplete/") ?>" + id,
            type: "POST",
            data: {
                id: id,
                active: status
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorSwal(message);
                } else {
                    successSwal(res.message);
                    window.location.reload(true);
                }
            }
        });
    }

    function markc(id) {
        $('#newcheck' + id).change(function() {
            if (this.checked) {
                complete_event(id, 'yes');
            } else {
                complete_event(id, 'no');
            }
        });
    }
</script>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="row">
    <div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel">
        <form action="<?php echo site_url('admin/admin/activeSession') ?>" id="form_modal_session" class="form-horizontal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="sessionModalLabel"><?php echo lang('Word.session'); ?></h4>
                    </div>
                    <div class="modal-body sessionmodal_body pb0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary submit_session" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait.."><?php echo lang('Word.save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="bed" class="modal fade bedmodal" role="dialog">
    <div class="modal-dialog modal100per">
        <!-- Modal content-->
        <div class="modal-content fullshadow">
            <button type="button" class="ukclose" data-dismiss="modal">&times;</button>
            <div class="modal-body">
                <div id="ajaxbedstatus"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function savedata(eventData) {
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/calendar/saveevent',
            type: 'POST',
            data: eventData,
            dataType: "json",
            success: function(msg) {
                alert(msg);

            }
        });
    }
</script>
<script type="text/javascript">
    $calendar = $('#calendar');
    var base_url = '<?php echo base_url() ?>';
    today = new Date();
    y = today.getFullYear();
    m = today.getMonth();
    d = today.getDate();
    var viewtitle = 'month';
    var pagetitle = "<?php
                        if (isset($title)) {
                            echo $title;
                        }
                        ?>";

    if (pagetitle == "Dashboard") {
        viewtitle = 'agendaWeek';
    }

    $calendar.fullCalendar({
        viewRender: function(view, element) {
            // We make sure that we activate the perfect scrollbar when the view isn't on Month

        },

        header: {
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
            left: 'prev,next,today'
        },
        defaultDate: today,
        defaultView: viewtitle,
        selectable: true,
        selectHelper: true,
        views: {
            month: { // name of view
                titleFormat: 'MMMM YYYY'
                // other view-specific options here
            },
            week: {
                titleFormat: " MMMM D YYYY"
            },
            day: {
                titleFormat: 'D MMM, YYYY'
            }
        },
        timezone: 'UTC',
        draggable: false,
        lang: '<?php echo $language_name ?>',
        editable: false,
        eventLimit: false, // allow "more" link when too many events
        // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
        events: {
            url: base_url + 'admin/calendar/getevents'

        },

        eventRender: function(event, element) {
            element.attr('title', event.title);
            element.attr('onclick', event.onclick);
            element.attr('data-toggle', 'tooltip');
            if ((!event.url) && (event.event_type != 'task')) {
                element.attr('title', event.title + '-' + event.description);
                element.click(function() {
                    view_event(event.id);

                });
            }
        },
        dayClick: function(date, jsEvent, view) {

            var d = date.format();
            if (!$.fullCalendar.moment(d).hasTime()) {
                d += ' 05:30';
            }



            var datetime_format = 'yyyy-mm-dd';

            $("#input-field").val('');
            $("#desc-field").text('');
            $("#date-field").daterangepicker({

                startDate: date,
                endDate: date,
                timePicker: true,
                timePickerIncrement: 5,
                locale: {
                    format: datetime_format

                }
            });

            $('#newEventModal').modal('show');

            return false;
        }
    });

    $(document).ready(function() {
        var datetime_format = '';

        $("#date-field").daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            locale: {
                format: datetime_format
            }
        });

        $('#addpatient_id').select2({
            ajax: {
                url: "<?= base_url(); ?>admin/patient/getPatientListAjax",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    $('#case_reference_idd').val('');
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
        $('#diag_awal').select2({
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
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
    });

    function datepic() {
        var datetime_format = 'MM/DD/YYYY h:mm A';

        $("#date-field").daterangepicker({
            format: datetime_format
        });
    }

    function view_event(id) {
        $('.selectevent').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
        var base_url = '<?php echo base_url() ?>';
        if (typeof(id) == 'undefined') {
            return;
        }

        var datetime_format = 'MM/DD/YYYY h:mm A';

        $.ajax({
            url: base_url + 'admin/calendar/view_event/' + id,
            type: 'POST',
            dataType: "json",
            success: function(msg) {
                $("#event_title").val(msg.event_title);
                $("#event_desc").text(msg.event_description);
                $('#eventdates').val(msg.start_date + '-' + msg.end_date);
                $('#eventid').val(id);
                if (msg.event_type == 'public') {
                    $('input:radio[name=eventtype]')[0].checked = true;
                } else if (msg.event_type == 'private') {
                    $('input:radio[name=eventtype]')[1].checked = true;
                } else if (msg.event_type == 'sameforall') {
                    $('input:radio[name=eventtype]')[2].checked = true;
                } else if (msg.event_type == 'protected') {
                    $('input:radio[name=eventtype]')[3].checked = true;
                }

                $("#eventdates").daterangepicker({
                    startDate: msg.startdate,
                    endDate: msg.enddate,
                    timePicker: true,
                    timePickerIncrement: 5,
                    locale: {
                        format: calendar_date_time_format + ' hh:mm A'
                    }
                });

                $("#event_color").val(msg.event_color);
                $("#delete_event").attr("onclick", "deleteevent(" + id + ",'Event ')");
                $("#" + msg.colorid).removeClass('cpicker-small').addClass('cpicker-big');
                $('#viewEventModal').modal('show');
            }
        });
    }

    var calendar_date_time_format = 'MM/DD/YYYY h:mm A';
    $(document).ready(function() {

        $("body").delegate(".date", "focusin", function() {
            var date_format = 'MM/DD/YYYY h:mm A';

            $(this).datepicker({
                todayHighlight: false,
                format: date_format,
                autoclose: true,
                language: '<?php echo $language_name ?>'
            });
        });

        var datetime_format = 'MM/DD/YYYY h:mm A';

        $("body").delegate(".datetime", "focusin", function() {
            $(this).datetimepicker({
                format: datetime_format,
                locale: '<?php echo $language_name ?>',

            });
        });
    });


    $(document).ready(function(e) {
        var datetime_format = 'MM/DD/YYYY h:mm A';
        $("body").delegate(".datetime", "focusin", function() {
            $(this).datetimepicker({
                format: datetime_format,
                locale: '<?php echo $language_name ?>',

            });
        });
        var date_format = 'MM/DD/YYYY h:mm A';
        var capital_date_format = date_format.toUpperCase();
        $.fn.dataTable.moment(capital_date_format);

        $("body").delegate(".date", "focusin", function() {

            $(this).datepicker({
                todayHighlight: false,
                format: date_format,
                autoclose: true,
                language: '<?php echo $language_name ?>'
            });
        });

        var daterange_format = 'MM/DD/YYYY h:mm A';
        $("body").delegate(".daterange", "focusin", function() {
            $(this).daterangepicker({
                locale: {
                    format: daterange_format,
                },

            });
        });
    });

    $(document).ready(function(e) {
        var date_format = 'MM/DD/YYYY h:mm A';
        $("body").on("focusin", ".billDateDisabled", function() {
            $(this).datepicker({
                format: date_format,
                setDate: new Date(),
                autoclose: true,
                todayHighlight: true,
                endDate: '+0d',
            });
        });
    });

    $(document).ready(function(e) {
        $("#addevent_form").on('submit', (function(e) {
            $("#addevent_formbtn").button('loading');
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/calendar/saveevent") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.status == "fail") {
                        var message = "";
                        $.each(res.error, function(index, value) {
                            message += value;
                        });
                        errorSwal(message);

                    } else {
                        successSwal(res.message);
                        window.location.reload(true);
                    }
                    $("#addevent_formbtn").button('reset');
                }
            });
        }));
    });

    $(document).ready(function(e) {
        $("#updateevent_form").on('submit', (function(e) {
            $("#updateevent_formbtn").button('loading');
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/calendar/updateevent") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.status == "fail") {
                        var message = "";
                        $.each(res.error, function(index, value) {
                            message += value;
                        });
                        errorSwal(message);
                    } else {
                        successSwal(res.message);
                        window.location.reload(true);
                    }
                    $("#updateevent_formbtn").button('reset');
                }
            });
        }));
    });

    function deleteevent(id, msg) {
        if (typeof(id) == 'undefined') {
            return;
        }
        if (confirm("<?php echo lang('Word.are_you_sure_to_delete_this') ?>" + ' ' + msg + " !")) {
            $.ajax({
                url: base_url + 'admin/calendar/delete_event/' + id,
                type: 'POST',
                dataType: "json",
                success: function(res) {
                    if (res.status == "fail") {
                        errorSwal(res.message);
                    } else {
                        successSwal(msg + "<?php echo lang('Word.delete_message') ?>");
                        window.location.reload(true);
                    }
                }
            })
        }
    }

    $("body").on('click', '.cpicker', function() {
        var color = $(this).data('color');
        // Clicked on the same selected color
        if ($(this).hasClass('cpicker-big')) {
            return false;
        }

        $(this).parents('.cpicker-wrapper').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
        $(this).removeClass('cpicker-small', 'fast').addClass('cpicker-big', 'fast');
        if ($(this).hasClass('kanban-cpicker')) {
            $(this).parents('.panel-heading-bg').css('background', color);
            $(this).parents('.panel-heading-bg').css('border', '1px solid ' + color);
        } else if ($(this).hasClass('calendar-cpicker')) {
            $("body").find('input[name="eventcolor"]').val(color);
        }
    });

    <?php if (isset($bedid)) { ?>
        add_inpatient('<?php echo $bedid ?>', '<?php echo $bedgroupid ?>');
    <?php } ?>

    function getbedstatus() {
        $("#beddata").button('loading');
        $.ajax({
            url: base_url + 'admin/patient/getBedStatus/',
            type: 'POST',
            data: '',
            success: function(res) {
                $("#ajaxbedstatus").html(res);
                $("#bed").modal('show');
                $("#beddata").button('reset');
            }
        })
    }

    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function closeModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    }
</script>

<?php $this->renderSection('jsContent'); ?>