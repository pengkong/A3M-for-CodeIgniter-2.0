<?php echo form_open(uri_string().(empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'])); ?>
<?php echo form_fieldset(); ?>
    <div class="col-lg-12">
	<h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

	<p><?php echo lang('reset_password_captcha'); ?></p>
    </div>
    <div class="clearfix"></div>
		<?php if (isset($recaptcha)) : ?>
    <div class="col-lg-6">
			<?php echo $recaptcha; ?>
    </div>
    <div class="clearfix"></div>
		<?php if (isset($reset_password_recaptcha_error)) : ?>
	<div class="col-lg-6">
	    <span class="field_error"><?php echo $reset_password_recaptcha_error; ?></span>
	</div>
	<div class="clearfix"></div>
			<?php endif; ?>
		<?php endif; ?>
    <div class="col-lg-6">
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary', 'content' => lang('reset_password_captcha_submit'))); ?>
    </div>
<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>