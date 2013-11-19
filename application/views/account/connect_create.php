<h2><?php echo anchor(current_url(), lang('connect_create_account')); ?></h2>
<div class="form-horizontal">
	<?php echo form_open(uri_string()); ?>
	<?php echo form_fieldset(); ?>
    <h3><?php echo lang('connect_create_heading'); ?></h3>
	<?php if (isset($connect_create_error)) : ?>
		<div class="form_error"><?php echo $connect_create_error; ?></div>
	<?php endif; ?>
    <div class="control-group">
	<?php echo form_label(lang('connect_create_username'), 'connect_create_username', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo form_input(array('name' => 'connect_create_username', 'id' => 'connect_create_username', 'value' => set_value('connect_create_username') ? set_value('connect_create_username') : (isset($connect_create[0]['username']) ? $connect_create[0]['username'] : ''), 'maxlength' => '16')); ?>
		<?php echo form_error('connect_create_username'); ?>
		<?php if (isset($connect_create_username_error)) : ?>
			<span class="field_error"><?php echo $connect_create_username_error; ?></span>
		<?php endif; ?>
	</div>
    </div>
    <div class="control-group">
			<?php echo form_label(lang('connect_create_email'), 'connect_create_email', array('class' => 'control-label')); ?>
	<div class="controls">
			    <?php echo form_input(array('name' => 'connect_create_email', 'id' => 'connect_create_email', 'value' => set_value('connect_create_email') ? set_value('connect_create_email') : (isset($connect_create[0]['email']) ? $connect_create[0]['email'] : ''), 'maxlength' => '160')); ?>
			    <?php echo form_error('connect_create_email'); ?>
			    <?php if (isset($connect_create_email_error)) : ?>
	    <span class="field_error"><?php echo $connect_create_email_error; ?></span>
			    <?php endif; ?>
	</div>
    </div>
    <div class="offset2 span4">
			<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-prmary', 'content' => lang('connect_create_button'))); ?>
    </div>
		<?php echo form_fieldset_close(); ?>
		<?php echo form_close(); ?>
</div>