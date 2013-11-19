<?php if (! ($this->config->item("sign_up_enabled"))): ?>
	<div class="col-lg-12">
		<h3><?php echo lang('sign_up_heading'); ?></h3>
		
		<div class="alert">
			<strong><?php echo lang('notice');?> </strong> <?php echo lang('registration_disabled'); ?>
		</div>
	</div>
<?php endif;?>

<?php if ($this->config->item("sign_up_enabled")): ?>
	<div class="col-lg-6">
		
		<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
		<?php echo form_fieldset(); ?>
		<h3><?php echo lang('sign_up_heading'); ?></h3>
		
		<div class="well">
			
			<div id="usernameError" class="form-group <?php echo (form_error('sign_up_username') || isset($sign_up_username_error)) ? 'error' : ''; ?>">
				<label class="control-label col-lg-2" for="sign_up_username"><?php echo lang('sign_up_username'); ?></label>
				
				<div id="usernameControls" class="col-lg-10">
					<?php echo form_input(array('name' => 'sign_up_username', 'id' => 'sign_up_username', 'value' => set_value('sign_up_username'), 'maxlength' => '24', 'class' => 'form-control')); ?>
					<?php if (form_error('sign_up_username') || isset($sign_up_username_error)) : ?>
						<span class="help-inline">
						<?php echo form_error('sign_up_username'); ?>
						<?php if (isset($sign_up_username_error)) : ?>
							<span class="field_error"><?php echo $sign_up_username_error; ?></span>
						<?php endif; ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div id="passwordError" class="form-group <?php echo (form_error('sign_up_password')) ? 'error' : ''; ?>">
				<label class="control-label col-lg-2" for="sign_up_password"><?php echo lang('sign_up_password'); ?></label>
				
				<div id="passwordControls" class="col-lg-10">
					<?php echo form_password(array('name' => 'sign_up_password', 'id' => 'sign_up_password', 'value' => set_value('sign_up_password'), 'class' => 'form-control')); ?>
					<?php if (form_error('sign_up_password')) : ?>
						<span class="help-inline">
						<?php echo form_error('sign_up_password'); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div id="confirm_passwordError" class="form-group <?php echo (form_error('sign_up_confirm_password')) ? 'error' : ''; ?>">
				<label class="control-label col-lg-2" for="sign_up_confirm_password"><?php echo lang('sign_up_confirm_password'); ?></label>
				
				<div id="confirm_passwordControls" class="col-lg-10">
					<?php echo form_password(array('name' => 'sign_up_confirm_password', 'id' => 'sign_up_confirm_password', 'value' => set_value('sign_up_confirm_password'), 'class' => 'form-control')); ?>
					<?php if (form_error('sign_up_confirm_password')) : ?>
						<span class="help-inline">
						<?php echo form_error('sign_up_confirm_password'); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div id="emailError" class="form-group <?php echo (form_error('sign_up_email') || isset($sign_up_email_error)) ? 'error' : ''; ?>">
				<label class="control-label col-lg-2" for="sign_up_email"><?php echo lang('sign_up_email'); ?></label>
				
				<div id="emailControls" class="col-lg-10">
					<?php echo form_input(array('name' => 'sign_up_email', 'id' => 'sign_up_email', 'value' => set_value('sign_up_email'), 'maxlength' => '160', 'class' => 'form-control')); ?>
					<?php if (form_error('sign_up_email') || isset($sign_up_email_error)) : ?>
						<span class="help-inline">
						<?php echo form_error('sign_up_email'); ?>
						<?php if (isset($sign_up_email_error)) : ?>
							<span class="field_error"><?php echo $sign_up_email_error; ?></span>
						<?php endif; ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div class = "checkbox">
				<label>
					<input type="checkbox" name="sign_up_terms" value="agree"><?php echo lang('sign_up_terms');?>
				</label>
				<?php if (form_error('sign_up_terms') || isset($sign_up_terms_error)) : ?>
					<span class="help-inline">
					<?php echo form_error('sign_up_terms'); ?>
					<?php if (isset($sign_up_terms_error)) : ?>
						<span class="field_error"><?php echo $sign_up_terms_error; ?></span>
					<?php endif; ?>
					</span>
				<?php endif; ?>
			</div>
			
			<?php if (isset($recaptcha)) :
				echo $recaptcha;
				if (isset($sign_up_recaptcha_error)) : ?>
					<span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
				<?php endif; ?>
			<?php endif; ?>
			
			<div>
				<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-large pull-right', 'content' => '<i class="glyphicon glyphicon-pencil"></i> '.lang('sign_up_create_my_account'))); ?>
			</div>
			<br/>
			
			<p><?php echo lang('sign_up_already_have_account'); ?> <?php echo anchor('account/sign_in', lang('sign_up_sign_in_now')); ?></p>
		</div>
		
		<?php echo form_fieldset_close(); ?>
		<?php echo form_close(); ?>

	</div>

	<div class="col-lg-6">
		<?php if ($this->config->item('third_party_auth_providers')) : ?>
			<h3><?php echo sprintf(lang('sign_up_third_party_heading')); ?></h3>
			<ul>
				<?php foreach ($this->config->item('third_party_auth_providers') as $provider) : ?>
				<li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, ' ', array('title' => sprintf(lang('sign_up_with'), lang('connect_'.$provider)))); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div><!-- /span6 -->
<?php endif;?>