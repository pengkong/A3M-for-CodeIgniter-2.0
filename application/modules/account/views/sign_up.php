<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('sign_up_page_name'); ?></title>
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />
<link type="text/css" rel="stylesheet" href="resource/css/style.css" />
</head>
<body class="sign_up">
<?php echo $this->load->view('header'); ?>
<div id="content">
    <div class="container_12">
        <div class="grid_12">
            <h2><?php echo anchor(current_url(), lang('sign_up_page_name')); ?></h2>
        </div>
        <div class="clear"></div>
        <div class="grid_6">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <h3><?php echo lang('sign_up_heading'); ?></h3>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('sign_up_username'), 'sign_up_username'); ?>
            </div>
            <div class="grid_4 omega">
                <?php echo form_input(array(
                        'name' => 'sign_up_username',
                        'id' => 'sign_up_username',
                        'value' => set_value('sign_up_username'),
                        'maxlength' => '24'
                    )); ?>
                <?php echo form_error('sign_up_username'); ?>
                <?php if (isset($sign_up_username_error)) : ?>
                <span class="field_error"><?php echo $sign_up_username_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('sign_up_password'), 'sign_up_password'); ?>
            </div>
            <div class="grid_4 omega">
                <?php echo form_password(array(
                        'name' => 'sign_up_password',
                        'id' => 'sign_up_password',
                        'value' => set_value('sign_up_password')
                    )); ?>
                <?php echo form_error('sign_up_password'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('sign_up_email'), 'sign_up_email'); ?>
            </div>
            <div class="grid_4 omega">
                <?php echo form_input(array(
                        'name' => 'sign_up_email',
                        'id' => 'sign_up_email',
                        'value' => set_value('sign_up_email'),
                        'maxlength' => '160'
                    )); ?>
                <?php echo form_error('sign_up_email'); ?>
                <?php if (isset($sign_up_email_error)) : ?>
                <span class="field_error"><?php echo $sign_up_email_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <?php if (isset($recaptcha)) : ?>
            <div class="prefix_2 grid_4 alpha omega">
                <?php echo $recaptcha; ?>
            </div>
            <?php if (isset($sign_up_recaptcha_error)) : ?>
            <div class="prefix_2 grid_4 alpha omega">
                <span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
            </div>
            <?php endif; ?>
            <div class="clear"></div>
            <?php endif; ?>
            <div class="prefix_2 grid_4 alpha omega">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('sign_up_create_my_account')
                    )); ?>
            </div>
            <div class="prefix_2 grid_4 alpha omega">
                <p><?php echo lang('sign_up_already_have_account'); ?> <?php echo anchor('account/sign_in', lang('sign_up_sign_in_now')); ?></p>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="grid_6">
            <h3><?php echo sprintf(lang('sign_up_third_party_heading')); ?></h3>
            <ul>
                <?php foreach($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, lang('connect_'.$provider), 
                    array('title'=>sprintf(lang('sign_up_with'), lang('connect_'.$provider)))); ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>