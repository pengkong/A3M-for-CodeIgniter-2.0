<div class="col-lg-12">
	<?php if ($this->session->flashdata('password_info')) : ?>
	    <div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $this->session->flashdata('password_info'); ?>
	    </div>
	<?php endif; ?>

    <div class="page-header">
	<h1><?php echo lang('password_page_name'); ?></h1>
    </div>

    <div class="well">
	<?php echo lang('password_safe_guard_your_account'); ?>
    </div>

	<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
	<?php echo form_fieldset(); ?>

    <br>

    <div class="form-group <?php echo (form_error('password_new_password')) ? 'error' : ''; ?>">
	<label class="control-label col-lg-2" for="password_new_password"><?php echo lang('password_new_password'); ?></label>

	<div class="col-lg-10">
		<?php echo form_password(array('name' => 'password_new_password', 'id' => 'password_new_password', 'value' => set_value('password_new_password'), 'autocomplete' => 'off', 'class' => 'form-control')); ?>
		<?php if (form_error('password_new_password'))
			{
		?>
	    <span class="help-inline">
		<?php echo form_error('password_new_password'); ?>
		</span>
		<?php } ?>
	</div>
    </div>

    <div class="form-group <?php echo (form_error('password_retype_new_password')) ? 'error' : ''; ?>">
	<label class="control-label col-lg-2" for="password_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

	<div class="col-lg-10">
		<?php echo form_password(array('name' => 'password_retype_new_password', 'id' => 'password_retype_new_password', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off', 'class' => 'form-control')); ?>
		<?php if (form_error('password_retype_new_password'))
	{
		?>
		<span class="help-inline">
		<?php echo form_error('password_retype_new_password'); ?>
		</span>
		<?php } ?>
	</div>
    </div>


    <div class="form-group">
	<div class="col-lg-offset-2 col-lg-10">
		<button type="submit" class="btn btn-primary"><?php echo lang('password_change_my_password'); ?></button>
	</div>
    </div>

	<?php echo form_fieldset_close(); ?>
	<?php echo form_close(); ?>

</div>