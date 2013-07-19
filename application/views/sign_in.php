<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => lang('sign_in_page_name'))); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span6">

			<?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <h3><?php echo lang('sign_in_heading'); ?></h3>

            <div class="well">
				<?php if (isset($sign_in_error)) : ?>
                	<div class="form_error"><?php echo $sign_in_error; ?></div>
				<?php endif; ?>

                <div class="control-group <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'error' : ''; ?>">
                    <label class="control-label" for="sign_in_username_email"><?php echo lang('sign_in_username_email'); ?></label>

                    <div class="controls">
						<?php echo form_input(array('name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'value' => set_value('sign_in_username_email'), 'maxlength' => '24')); ?>
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

                <div class="control-group <?php echo form_error('sign_in_password') ? 'error' : ''; ?>">
                    <label class="control-label" for="sign_in_password"><?php echo lang('sign_in_password'); ?></label>

                    <div class="controls">
						<?php echo form_password(array('name' => 'sign_in_password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password'))); ?>
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

                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
							<?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'checked', 'checked' => $this->input->post('sign_in_remember'),)); ?>
							<?php echo lang('sign_in_remember_me'); ?>
                        </label>
                    </div>
                </div>

                <div>
					<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-large pull-right', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>
                </div>

                <p><?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password')); ?><br/>
					<?php echo sprintf(lang('sign_in_dont_have_account'), anchor('account/sign_up', lang('sign_in_sign_up_now'))); ?></p>

            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
        </div>
        <!-- /span6 -->

        <div class="span6">
			<?php if ($this->config->item('third_party_auth_providers')) : ?>
            <h3><?php echo sprintf(lang('sign_in_third_party_heading')); ?></h3>
            <ul>
				<?php foreach ($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, ' ', array('title' => sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?></li>
				<?php endforeach; ?>
            </ul>
			<?php endif; ?>
        </div>
        <!-- /span6 -->
    </div>

	<?php echo $this->load->view('footer'); ?>

</body>
</html>