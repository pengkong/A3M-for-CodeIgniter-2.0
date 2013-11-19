<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => lang('forgot_password_page_name'))); ?>
</head>
<body>
<?php echo $this->load->view('header'); ?>
<div class="container">
    <div class="row">
        <div class="span12">
			<?php echo form_open(uri_string().(empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'])); ?>
			<?php echo form_fieldset(); ?>
            <div class="span12">
                <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

                <p><?php echo lang('reset_password_captcha'); ?></p>
            </div>
            <div class="clear"></div>
			<?php if (isset($recaptcha)) : ?>
            <div class="span6">
				<?php echo $recaptcha; ?>
            </div>
            <div class="clear"></div>
			<?php if (isset($reset_password_recaptcha_error)) : ?>
                <div class="span6">
                    <span class="field_error"><?php echo $reset_password_recaptcha_error; ?></span>
                </div>
                <div class="clear"></div>
				<?php endif; ?>
			<?php endif; ?>
            <div class="span6">
				<?php echo form_button(array('type' => 'submit', 'class' => 'btn', 'content' => lang('reset_password_captcha_submit'))); ?>
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
