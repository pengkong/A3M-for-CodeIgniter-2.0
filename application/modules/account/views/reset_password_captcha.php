<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('reset_password_page_name'); ?></title>
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />
<link type="text/css" rel="stylesheet" href="resource/css/style.css" />
</head>
<body>
<?php echo $this->load->view('header'); ?>
<div id="content">
    <div class="container_12">
        <div class="grid_12">
            <?php echo form_open(uri_string().(empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'])); ?>
            <?php echo form_fieldset(); ?>
            <div class="grid_12 alpha omega">
                <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>
                <p><?php echo lang('reset_password_captcha'); ?></p>
            </div>
            <div class="clear"></div>
            <?php if (isset($recaptcha)) : ?>
            <div class="grid_6 alpha omega">
                <?php echo $recaptcha; ?>
            </div>
            <div class="clear"></div>
            <?php if (isset($reset_password_recaptcha_error)) : ?>
            <div class="grid_6 alpha omega">
                <span class="field_error"><?php echo $reset_password_recaptcha_error; ?></span>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="grid_6 alpha omega">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('reset_password_captcha_submit')
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