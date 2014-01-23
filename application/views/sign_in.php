<div class="col-lg-6">
	<?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="form-horizontal"'); ?>
	<?php echo form_fieldset(); ?>

    <h3><?php echo lang('sign_in_heading'); ?></h3>

    <div class="well">
		<?php if (isset($sign_in_error)) : ?>
	<div class="alert alert-danger"><?php echo $sign_in_error; ?></div>
		<?php endif; ?>

	<div class="form-group <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'error' : ''; ?>">
	    <label class="control-label col-lg-2" for="sign_in_username_email"><?php echo lang('sign_in_username_email'); ?></label>

	    <div class="col-lg-10">
			<?php echo form_input(array('name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'value' => set_value('sign_in_username_email'), 'maxlength' => '24', 'class' => 'form-control')); ?>
			<?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
	<span class="help-inline">
			<?php echo form_error('sign_in_username_email'); ?>
				<?php if (isset($sign_in_username_email_error)) : ?>
		<span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
				<?php endif; ?>
			</span>
			<?php endif; ?>
	    </div>
	</div>

	<div class="form-group <?php echo form_error('sign_in_password') ? 'error' : ''; ?>">
	    <label class="control-label col-lg-2" for="sign_in_password"><?php echo lang('sign_in_password'); ?></label>

	    <div class="col-lg-10">
		<?php echo form_password(array('name' => 'sign_in_password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password'), 'class' => 'form-control')); ?>
		<?php if (form_error('sign_in_password')) : ?>
			<span class="help-inline"><?php echo form_error('sign_in_password'); ?></span>
		<?php endif; ?>

		<?php if (isset($recaptcha)) : ?>
			<?php echo $recaptcha; ?>
			<?php if (isset($sign_in_recaptcha_error)) : ?>
				<span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
			<?php endif; ?>
		<?php endif; ?>
	    </div>
	</div>

	<div class="form-group">
	    <div class="col-lg-10 col-lg-offset-2">
		<label class="checkbox">
			<?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'checked', 'checked' => $this->input->post('sign_in_remember'))); ?>
			<?php echo lang('sign_in_remember_me'); ?>
		</label>
	    </div>
	</div>

	<div>
		<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-default btn-large pull-right', 'content' => '<i class="glyphicon glyphicon-lock"></i> '.lang('sign_in_sign_in'))); ?>
	</div>

	<p><?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password')); ?><br/>
		<?php echo lang('sign_in_dont_have_account') . " " . anchor('account/sign_up', lang('sign_in_sign_up_now')); ?></p>

    </div>
	<?php echo form_fieldset_close(); ?>
	<?php echo form_close(); ?>
</div>
<!-- /span6 -->

<div class="col-lg-6">
	<?php if ($third_party_auth = $this->config->item('third_party_auth')) : ?>
		<h3><?php echo sprintf(lang('sign_up_third_party_heading')); ?></h3>
		<ul>
			<?php foreach($third_party_auth['providers'] as $provider_name => $provider_values) : ?>
				<?php if($provider_values['enabled']) : ?>
				<li class="third_party"><?php echo anchor('account/connect/'.$provider_name, '<img src="'.base_url(RES_DIR.'/img/auth_icons/'.strtolower($provider_name).'.png').'" alt="'.sprintf(lang('sign_up_with'), lang('connect_'.strtolower($provider_name))).'" height="64" width="64">' ); ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div><!-- /span6 -->