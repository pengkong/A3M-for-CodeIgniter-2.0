<h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

<p><?php echo lang('reset_password_unsuccessful'); ?></p>

<p><?php echo anchor('account/forgot_password', lang('reset_password_resend'), array('class' => 'button')); ?></p>