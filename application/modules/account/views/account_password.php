<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('password_page_name'); ?></title>
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />
<link type="text/css" rel="stylesheet" href="resource/css/style.css" />
</head>
<body>
<?php echo $this->load->view('header'); ?>
<?php echo $this->load->view('account/account_menu', array('current' => 'account_password')); ?>
<div id="content">
    <div class="container_12">
        <div class="grid_12">
            <h2><?php echo anchor(current_url(), lang('password_page_name')); ?></h2>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <?php if ($this->session->flashdata('password_info')) : ?>
            <div class="grid_8 alpha omega">
                <div class="form_info"><?php echo $this->session->flashdata('password_info'); ?></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php echo lang('password_safe_guard_your_account'); ?>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('password_new_password'), 'password_new_password'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_password(array(
                        'name' => 'password_new_password',
                        'id' => 'password_new_password',
                        'value' => set_value('password_new_password'),
                        'autocomplete' => 'off'
                    )); ?>
                <?php echo form_error('password_new_password'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('password_retype_new_password'), 'password_retype_new_password'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_password(array(
                        'name' => 'password_retype_new_password',
                        'id' => 'password_retype_new_password',
                        'value' => set_value('password_retype_new_password'),
                        'autocomplete' => 'off'
                    )); ?>
                <?php echo form_error('password_retype_new_password'); ?>
            </div>
            <div class="clear"></div>
            <div class="prefix_2 grid_6 alpha omega">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('password_change_my_password')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>