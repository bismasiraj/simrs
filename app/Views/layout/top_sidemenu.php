<ul class="sessionul fixedmenu" style="display: none;">
    <li class="dropdown">
        <a class="dropdown-toggle drop5" data-toggle="dropdown" href="#" aria-expanded="false">
            <span><?php echo lang('quick_links'); ?></span> <i class="glyphicon glyphicon-th pull-right"></i>
        </a>
        <ul class="dropdown-menu verticalmenu" style="min-width:194px;font-size:10pt;left:3px;">
            <?php //if ($this->rbac->hasPrivilege('student', 'can_view')) { 
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>student/search"><i class="fa fa-user-plus"></i><?php echo lang('student_details'); ?></a></li>
            <?php //} 
            ?>
            <?php //if ($this->rbac->hasPrivilege('income', 'can_add')) { 
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/income"> &nbsp;<i class="fa fa-usd"></i> <?php echo lang('add_income'); ?></a></li>
            <?php //} 
            ?>
            <?php //if ($this->rbac->hasPrivilege('expense', 'can_view')) { 
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-credit-card"></i><?php echo lang('add_expense'); ?></a></li>
            <?php //} 
            ?>

            <?php //if ($this->rbac->hasPrivilege('staff_attendance', 'can_view')) {
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/staffattendance"><i class="fa fa-calendar-check-o"></i><?php echo lang('staff_attendance'); ?></a></li>
            <?php //}
            //if ($this->rbac->hasPrivilege('staff', 'can_view')) { 
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/staff"><i class="fa fa-calendar-check-o"></i><?php echo lang('staff_directory'); ?></a></li>
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
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/complaint"><i class="fa fa-calendar-check-o"></i><?php echo lang('complain'); ?></a></li>
            <?php //}
            //if ($this->rbac->hasPrivilege('upload_content', 'can_view')) { 
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/content"><i class="fa fa-download"></i><?php echo lang('upload_content'); ?></a></li>
            <?php
            //}
            //if ($this->rbac->hasPrivilege('item_stock', 'can_add')) {
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/itemstock"><i class="fa fa-object-group"></i><?php echo lang('add_item_stock'); ?></a></li>
            <?php
            //}
            //if ($this->rbac->hasPrivilege('notice_board', 'can_view')) {
            ?>
            <li role="presentation"><a style="color:#282828; font-family: 'Roboto-Bold';padding:6px 20px;" role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-bullhorn"></i><?php echo lang('notice_board'); ?></a></li>
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