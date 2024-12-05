<!-- <aside class="main-sidebar" id="alert2">
    <section class="sidebar" id="sibe-box">
        <?php view('layout/top_sidemenu'); ?>
        <ul class="sidebar-menu verttop">
            <li class="treeview <?= uri_string(); ?>">
                <a href="<?php echo base_url(); ?>admin/admin/dashboard">
                    <i class="fas fa-television"></i> <span> <?php echo lang('dashboard'); ?></span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo site_url('admin/bill/dashboard'); ?>">
                    <i class="fas fa-file-invoice"></i> <span> <?php echo lang('billing'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('appointment'); ?>">
                <a href="<?php echo base_url(); ?>admin/appointment/index">
                    <i class="fa fa-calendar-check-o"></i> <span><?php echo lang('appointment'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('OPD_Out_Patient'); ?>">
                <a href="<?php echo base_url(); ?>admin/patient/search">
                    <i class="fas fa-stethoscope"></i> <span> <?php echo lang('opd_out_patient'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('IPD_in_patient'); ?>">
                <a href="<?php echo base_url() ?>admin/patient/ipdsearch">
                    <i class="fas fa-procedures" aria-hidden="true"></i> <span> <?php echo lang('ipd_in_patient'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('pharmacy'); ?>">
                <a href="<?php echo base_url(); ?>admin/pharmacy/bill">
                    <i class="fas fa-mortar-pestle"></i> <span> <?php echo lang('pharmacy'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('pathology'); ?>">
                <a href="<?php echo base_url(); ?>admin/pathology/gettestreportbatch">
                    <i class="fas fa-flask"></i> <span><?php echo lang('pathology'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('radiology'); ?>">

                <a href="<?php echo base_url() ?>admin/radio/gettestreportbatch">
                    <i class="fas fa-microscope"></i> <span><?php echo lang('radiology'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('blood_bank'); ?>">
                <a href="<?php echo base_url() ?>admin/bloodbankstatus/">
                    <i class="fas fa-tint"></i> <span><?php echo lang('blood_bank'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('Transport'); ?>">
                <a href="<?php echo base_url(); ?>admin/vehicle/getcallambulance">
                    <i class="fas fa-ambulance" aria-hidden="true"></i>
                    <span> <?php echo lang('ambulance'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('front_office'); ?>">
                <a href="<?php echo base_url(); ?>admin/visitors">
                    <i class="fas fa-dungeon"></i> <span><?php echo lang('front_office'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('birthordeath'); ?>">
                <a href="<?php echo base_url(); ?>admin/birthordeath"><i class="fa fa-birthday-cake" aria-hidden="true"></i><span> <?php echo lang('birth_death_record'); ?></span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('birthordeath/index'); ?>"><a href="<?php echo base_url(); ?>admin/birthordeath"><i class="fas fa-angle-right"></i> <?php echo lang('birth_record'); ?> </a></li>
                    <li class="<?php echo ('birthordeath/death'); ?>"><a href="<?php echo base_url(); ?>admin/birthordeath/death"><i class="fas fa-angle-right"></i> <?php echo lang('death_record'); ?></a></li>

                </ul>
            </li>
            <li class="treeview <?php echo ('HR'); ?>">
                <a href="<?php echo base_url(); ?>admin/staff">
                    <i class="fas fa-sitemap"></i> <span><?php echo lang('human_resource'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('referral_payment'); ?>">
                <a href="<?php echo base_url(); ?>admin/referral/payment">
                    <i class="fas fa-users"></i> <span><?php echo lang('referral'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('tpa_management'); ?>">
                <a href="<?php echo base_url() ?>admin/tpamanagement">
                    <i class="fas fa-umbrella"></i> <span><?php echo lang('tpa_management'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('finance'); ?>">
                <a href="<?php echo base_url(); ?>admin/patient/search">
                    <i class="fas fa-money-bill-wave"></i> <span><?php echo lang('finance'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fas fa-angle-right"></i> <?php echo lang('income'); ?> </a></li>
                    <li class="<?php echo ('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/expense"><i class="fas fa-angle-right"></i> <?php echo lang('expenses'); ?></a></li>

                </ul>
            </li>
            <li class="treeview <?php echo ('Messaging'); ?>">
                <a href="<?php echo base_url(); ?>admin/notification">
                    <i class="fas fa-bullhorn"></i> <span><?php echo lang('messaging'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('Inventory'); ?>">
                <a href="<?php echo base_url(); ?>admin/itemstock">
                    <i class="fas fa-luggage-cart"></i> <span><?php echo lang('inventory'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('Download Center'); ?>">
                <a href="<?php echo base_url(); ?>admin/content">
                    <i class="fas fa-download"></i> <span><?php echo lang('download_center'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('Certificate'); ?>">
                <a href="#">
                    <i class="fa fa-newspaper-o ftlayer"></i> <span><?php echo lang('certificate'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('admin/generatecertificate'); ?>"><a href="<?php echo base_url(); ?>admin/generatecertificate"><i class="fas fa-angle-right"></i><?php echo lang('certificate'); ?> </a></li>
                    <li class="<?php echo ('admin/generatepatientidcard'); ?>"><a href="<?php echo base_url('admin/generatepatientidcard/'); ?>"><i class="fas fa-angle-right"></i><?php echo lang('patient_id_card'); ?></a></li>
                    <li class="<?php echo ('admin/generatestaffidcard'); ?>"><a href="<?php echo base_url('admin/generatestaffidcard/'); ?>"><i class="fas fa-angle-right"></i><?php echo lang('staff_id_card'); ?></a></li>
                </ul>
            </li>
            <li class="treeview <?php echo ('Front CMS'); ?>">
                <a href="<?php echo base_url(); ?>admin/front/page">
                    <i class="fas fa-solar-panel"></i> <span><?php echo lang('front_cms'); ?></span>
                </a>
            </li>
            <li class="treeview <?php echo ('conference'); ?>">
                <a href="#">
                    <i class="fa fa-video-camera ftlayer"></i> <span><?php echo lang('live_consultation'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('conference/live_consult'); ?>"><a href="<?php echo base_url('admin/zoom_conference/consult'); ?>"><i class="fas fa-angle-right"></i> <?php echo lang('live_consultation'); ?></a></li>
                    <li class="<?php echo ('conference/live_meeting'); ?>"><a href="<?php echo base_url('admin/zoom_conference/meeting'); ?>"><i class="fas fa-angle-right"></i> <?php echo lang('live_meeting'); ?> </a></li>
                </ul>
            </li>
            <li class="treeview <?php echo ('Reports'); ?>">
                <a href="#">
                    <i class="fas fa-line-chart"></i> <span><?php echo lang('reports'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('admin/transaction/dailytransactionreport'); ?>"><a href="<?php echo base_url(); ?>admin/transaction/transactionreport"><i class="fas fa-angle-right"></i> <?php echo lang("daily_transaction_report"); ?></a>
                    </li>
                    <li class="<?php echo ('admin/income/alltransactionreport'); ?>"><a href="<?php echo base_url(); ?>admin/income/alltransactionreport"><i class="fas fa-angle-right"></i> <?php echo lang("all_transaction_report"); ?></a>
                    </li>


                    <li class="<?php echo ('admin/appointment/appointmentreport'); ?>"><a href="<?php echo base_url(); ?>admin/appointment/appointmentreport"><i class="fas fa-angle-right"></i> <?php echo lang('appointment_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/opd_report'); ?>"><a href="<?php echo base_url(); ?>admin/patient/opd_report"><i class="fas fa-angle-right"></i> <?php echo lang('opd_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/ipdreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/ipdreport"><i class="fas fa-angle-right"></i> <?php echo lang('ipd_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/opdreportbalance'); ?>"><a href="<?php echo base_url(); ?>admin/patient/opdreportbalance"><i class="fas fa-angle-right"></i> <?php echo lang('opd_balance_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/ipdreportbalance'); ?>"><a href="<?php echo base_url(); ?>admin/patient/ipdreportbalance"><i class="fas fa-angle-right"></i> <?php echo lang('ipd_balance_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/opddischargepatientReport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/opddischargepatientreport"><i class="fas fa-angle-right"></i> <?php echo lang('opd_discharged_patient'); ?></a></li>
                    <li class="<?php echo ('admin/patient/dischargepatientreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/dischargepatientreport"><i class="fas fa-angle-right"></i> <?php echo lang('ipd_discharged_patient'); ?></a></li>
                    <li class="<?php echo ('admin/pharmacy/billreport'); ?>"><a href="<?php echo base_url(); ?>admin/pharmacy/billreport"><i class="fas fa-angle-right"></i> <?php echo lang('pharmacy_balance_report'); ?></a></li>
                    <li class="<?php echo ('admin/expmedicine/expmedicinereport'); ?>"><a href="<?php echo base_url(); ?>admin/expmedicine/expmedicinereport"><i class="fas fa-angle-right"></i> <?php echo lang('expiry_medicine_report'); ?></a></li>
                    <li class="<?php echo ('admin/pathology/pathologyreport'); ?>"><a href="<?php echo base_url(); ?>admin/pathology/pathologyreport"><i class="fas fa-angle-right"></i> <?php echo lang('pathology_patient_report'); ?></a></li>
                    <li class="<?php echo ('admin/radio/radiologyreport'); ?>"><a href="<?php echo base_url(); ?>admin/radio/radiologyreport"><i class="fas fa-angle-right"></i> <?php echo lang('radiology_patient_report'); ?></a></li>
                    <li class="<?php echo ('admin/operationtheatre/otreport'); ?>"><a href="<?php echo base_url(); ?>admin/operationtheatre/otreport"><i class="fas fa-angle-right"></i> <?php echo lang('ot_report'); ?></a></li>
                    <li class="<?php echo ('admin/bloodbank/bloodissuereport'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/bloodissuereport"><i class="fas fa-angle-right"></i> <?php echo lang('blood_issue_report'); ?></a></li>
                    <li class="<?php echo ('admin/bloodbank/componentissuereport'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/componentissuereport"><i class="fas fa-angle-right"></i> <?php echo lang('component_issue_report'); ?></a></li>
                    <li class="<?php echo ('admin/bloodbank/blooddonorreport'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/blooddonorreport"><i class="fas fa-angle-right"></i> <?php echo lang('blood_donor_report'); ?></a></li>
                    <li class="<?php echo ('zoom_conference/consult_report'); ?>"><a href="<?php echo base_url('admin/zoom_conference/consult_report'); ?>"><i class="fas fa-angle-right"></i> <?php echo lang('live_consultation_report'); ?></a></li>
                    <li class="<?php echo ('zoom_conference/meeting_report'); ?>"><a href="<?php echo base_url('admin/zoom_conference/meeting_report'); ?>"><i class="fas fa-angle-right"></i> <?php echo lang('live_meeting_report'); ?></a></li>
                    <li class="<?php echo ('admin/tpamanagement/tpareport'); ?>"><a href="<?php echo base_url(); ?>admin/tpamanagement/tpareport"><i class="fas fa-angle-right"></i> <?php echo lang('tpa_report'); ?></a></li>
                    <li class="<?php echo ('admin/income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fas fa-angle-right"></i> <?php echo lang('income_report'); ?></a></li>
                    <li class="<?php echo ('reports/incomegroup'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomegroup"><i class="fas fa-angle-right"></i> <?php echo lang('income_group_report'); ?></a></li>
                    <li class="<?php echo ('admin/expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fas fa-angle-right"></i> <?php echo lang('expense_report'); ?></a></li>
                    <li class="<?php echo ('reports/expensegroup'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensegroup"><i class="fas fa-angle-right"></i> <?php echo lang('expense_group_report'); ?></a></li>
                    <li class="<?php echo ('admin/vehicle/ambulancereport'); ?>"><a href="<?php echo base_url(); ?>admin/vehicle/ambulancereport"><i class="fas fa-angle-right"></i> <?php echo lang('ambulance_report'); ?></a></li>
                    <li class="<?php echo ('admin/birthordeath/birthreport'); ?>"><a href="<?php echo base_url(); ?>admin/birthordeath/birthreport"><i class="fas fa-angle-right"></i> <?php echo lang('birth_report'); ?></a></li>
                    <li class="<?php echo ('admin/birthordeath/deathreport'); ?>"><a href="<?php echo base_url(); ?>admin/birthordeath/deathreport"><i class="fas fa-angle-right"></i> <?php echo lang('death_report'); ?></a></li>
                    <li class="<?php echo ('admin/payroll/payrollreport'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollreport"><i class="fas fa-angle-right"></i> <?php echo lang('payroll_month_report'); ?></a></li>
                    <li class="<?php echo ('admin/payroll/payrollsearch'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollsearch"><i class="fas fa-angle-right"></i> <?php echo lang('payroll_report'); ?></a></li>
                    <li class="<?php echo ('admin/staffattendance/attendancereport'); ?>"><a href="<?php echo base_url(); ?>admin/staffattendance/attendancereport"><i class="fas fa-angle-right"></i> <?php echo lang('staff_attendance_report'); ?></a></li>
                    <li class="<?php echo ('userlog/index'); ?>"><a href="<?php echo base_url(); ?>admin/userlog"><i class="fas fa-angle-right"></i> <?php echo lang('user_log'); ?></a></li>
                    <li class="<?php echo ('admin/patient/patientcredentialreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/patientcredentialreport"><i class="fas fa-angle-right"></i> <?php echo lang('patient_login_credential'); ?></a></li>
                    <li class="<?php echo ('mailsms/index'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/index"><i class="fas fa-angle-right"></i> <?php echo lang('email_sms_log'); ?></a></li>
                    <li class="<?php echo ('Reports/itemreport'); ?>"><a href="<?php echo base_url(); ?>admin/item/itemreport"><i class="fas fa-angle-right"></i> <?php echo lang('inventory_stock_report'); ?></a></li>
                    <li class="<?php echo ('Reports/additemreport'); ?>"><a href="<?php echo base_url(); ?>admin/item/additemreport"><i class="fas fa-angle-right"></i> <?php echo lang('inventory_item_report'); ?></a></li>
                    <li class="<?php echo ('Reports/issueinventoryreport'); ?>"><a href="<?php echo base_url(); ?>admin/issueitem/issueinventoryreport"><i class="fas fa-angle-right"></i> <?php echo lang('inventory_issue_report'); ?></a></li>
                    <li class="<?php echo ('admin/audit/index'); ?>"><a href="<?php echo base_url(); ?>admin/audit/index"><i class="fas fa-angle-right"></i> <?php echo lang('audit_trail_report'); ?></a></li>
                    <li class="<?php echo ('admin/patient/patientvisitreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/patientvisitreport"><i class="fas fa-angle-right"></i> <?php echo lang("patient_visit_report"); ?></a></li>
                    <li class="<?php echo ('admin/patient/patientbillreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/patientbillreport"><i class="fas fa-angle-right"></i> <?php echo lang("patient_bill_report"); ?></a></li>
                    <li class="<?php echo ('admin/referral/report'); ?>"><a href="<?php echo base_url(); ?>admin/referral/report"><i class="fas fa-angle-right"></i> <?php echo lang("referral_report"); ?></a></li>
                </ul>
            </li>
            <li class="treeview <?php echo ('setup'); ?>">
                <a href="<?php echo base_url(); ?>">
                    <i class="fas fa-cogs"></i> <span><?php echo lang('setup'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ('schsettings/index'); ?>"><a href="<?php echo base_url(); ?>schsettings"><i class="fas fa-angle-right"></i> <?php echo lang('settings'); ?></a></li>
                    <li class="<?php echo ('setup/patient'); ?>"> <a href="<?php echo base_url(); ?>admin/admin/search"><i class="fas fa-angle-right"></i> <?php echo lang('patient'); ?></a></li>
                    <li class="<?php echo ('charges/index'); ?>"><a href="<?php echo base_url(); ?>admin/charges"><i class="fas fa-angle-right"></i> <?php echo lang('hospital_charges'); ?></a></li>
                    <li class="<?php echo ('bed'); ?>"><a href="<?php echo base_url(); ?>admin/setup/bed/status"><i class="fas fa-angle-right"></i> <?php echo lang('bed'); ?></a></li>
                    <li class="<?php echo ('admin/printing'); ?>"><a href="<?php echo base_url(); ?>admin/printing"><i class="fas fa-angle-right"></i> <?php echo lang('print_header_footer'); ?></a></li>
                    <li class="<?php echo ('admin/visitorspurpose'); ?>"><a href="<?php echo base_url(); ?>admin/visitorspurpose"><i class="fas fa-angle-right"></i> <?php echo lang('front_office'); ?></a></li>
                    <li class="<?php echo ('operation_theatre/index'); ?>"><a href="<?php echo base_url(); ?>admin/operationtheatre/index"><i class="fas fa-angle-right"></i> <?php echo lang('operations'); ?></a></li>
                    <li class="<?php echo ('medicine/index'); ?>"><a href="<?php echo base_url(); ?>admin/medicinecategory/index"><i class="fas fa-angle-right"></i> <?php echo lang('pharmacy'); ?></a></li>
                    <li class="<?php echo ('addCategory/index'); ?>"><a href="<?php echo base_url(); ?>admin/pathologycategory/addcategory"><i class="fas fa-angle-right"></i> <?php echo lang('pathology'); ?></a></li>
                    <li class="<?php echo ('addlab/index'); ?>"><a href="<?php echo base_url(); ?>admin/lab/addlab"><i class="fas fa-angle-right"></i> <?php echo lang('radiology'); ?></a></li>
                    <li class="<?php echo ('admin/bloodbank'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/products"><i class="fas fa-angle-right"></i> <?php echo lang('blood_bank'); ?></a></li>
                    <li class="<?php echo ('symptoms/index'); ?>"><a href="<?php echo base_url(); ?>admin/symptoms"><i class="fas fa-angle-right"></i> <?php echo lang('symptoms'); ?></a></li>
                    <li class="<?php echo ('finding/index'); ?>"><a href="<?php echo base_url(); ?>admin/finding"><i class="fas fa-angle-right"></i> <?php echo lang('findings'); ?></a></li>
                    <li class="<?php echo ('conference/zoom_api_setting'); ?>"><a href="<?php echo base_url('admin/zoom_conference'); ?>"><i class="fas fa-angle-right"></i> <?php echo lang('zoom_setting') ?></a></li>
                    <li class="<?php echo ('finance/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fas fa-angle-right"></i> <?php echo lang('finance'); ?></a></li>
                    <li class="<?php echo ('finance/index'); ?>"><a href="<?php echo base_url(); ?>admin/expensehead"><i class="fas fa-angle-right"></i> <?php echo lang('finance'); ?></a></li>
                    <li class="<?php echo ('hr/index'); ?>"><a href="<?php echo base_url(); ?>admin/leavetypes"><i class="fas fa-angle-right"></i> <?php echo lang('human_resource'); ?></a></li>
                    <li class="<?php echo ('admin/referral/commission'); ?>"><a href="<?php echo base_url(); ?>admin/referral/commission"><i class="fas fa-angle-right"></i> <?php echo lang('referral'); ?></a></li>
                    <li class="<?php echo ('admin/onlineappointment'); ?>"><a href="<?php echo base_url(); ?>admin/onlineappointment/"><i class="fas fa-angle-right"></i> <?php echo lang('appointment'); ?></a></li>
                    <li class="<?php echo ('inventory/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemcategory"><i class="fas fa-angle-right"></i> <?php echo lang('inventory'); ?></a></li>
                    <li class="<?php echo ('customfield/index'); ?>"><a href="<?php echo base_url(); ?>admin/customfield"><i class="fas fa-angle-right"></i> <?php echo lang('custom_fields'); ?></a></li>
                </ul>
            </li>
            <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                <li class="<?= $basecontroller->checkMenuActive('get_send'); ?>">
                    <a href="<?php echo base_url(); ?>admin/Antrian/get_send">
                        <i class="fas fa-tasks"></i> <span><?php echo "Manajement Antrian"; ?></span>
                    </a>
                </li>

            <?php } ?>

            <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                <li class="<?= $basecontroller->checkMenuActive('rl'); ?>">
                    <a href="#" class="has-arrow waves-effect">
                        <i class="fas fa-dot-circle"></i><span>Report RL</span>
                    </a>
                    <ul class="-menu">
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_1_1"><i
                                    class="mdi mdi-chevron-right"></i>RL 1.1 Data Dasar Rumah Sakit</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_1_3"><i
                                    class="mdi mdi-chevron-right"></i>RL 1.3 Tempat Tidur</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_2"><i
                                    class="mdi mdi-chevron-right"></i>RL 2 Ketenagaan</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_1"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.1 KEGIATAN PELAYANAN RAWAT INAP</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_3"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.3 PELAYANAN GIGI MULUT</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_6"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.6 KEGIATAN PEMBEDAHAN</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_7"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.7 KEGIATAN RADIOLOGI</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_8"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.8 KEGIATAN LABORATORIUM</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_9"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.9 REHABILITASI MEDIK</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_10"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.8 KEGIATAN PELAYANAN KHUSUS</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_11"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.11 KESEHATAN JIWA</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_13"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.13 PENGADAAN OBAT</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_14"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.14 KEGIATAN RUJUKAN</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_3_15"><i
                                    class="mdi mdi-chevron-right"></i>RL 3.15 CARA BAYAR</a>
                        </li>

                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_4_A"><i
                                    class="mdi mdi-chevron-right"></i>RL 4-A DATA KEADAAN MORBIDITAS PASIEN RAWAT INAP
                                RUMAH SAKIT</a>
                        </li>
                        <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                href="<?php echo base_url(); ?>admin/report/rl_4_B"><i
                                    class="mdi mdi-chevron-right"></i>RL 4-B DATA KEADAAN MORBIDITAS PASIEN RAWAT JALAN
                                RUMAH SAKIT</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </section>
</aside> -->