<?php if (isset($profile_info))
    {
?>
    <div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	    <?php echo $profile_info; ?>
    </div>
<?php } ?>

<div class="page-header">
    <h1><?php echo lang('profile_page_name'); ?></h1>
</div>

<div class="well"><?php echo lang('profile_instructions'); ?></div>

<?php echo form_open_multipart(uri_string(), 'class="form-horizontal" role="form"'); ?>
<?php echo form_fieldset(); ?>

<div class="form-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
    <label class="control-label col-lg-2" for="profile_username"><?php echo lang('profile_username'); ?></label>

    <div class="col-lg-10">
	<?php echo form_input(array('name' => 'profile_username', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24', 'class' => 'form-control')); ?>
	<?php if (form_error('profile_username') || isset($profile_username_error))
	{
	    echo '<span class="help-inline">';
	    echo form_error('profile_username');
	    echo isset($profile_username_error) ? $profile_username_error : '';
	    echo '</span>';
	} ?>
    </div>
</div>

<div class="form-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
    <label class="control-label col-lg-2" <?php if (!(isset($account_details->picture) && strlen(trim($account_details->picture)) > 0)){ ?> for="pic_selection"<?php } ?>><?php echo lang('profile_picture'); ?></label>

    <div class="col-lg-10">
    <p>
	<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
	<?php echo showPhoto($account_details->picture); ?> &nbsp;
	<?php echo anchor('account/profile/index/delete', '<i class="glyphicon glyphicon-trash"></i> '.lang('profile_delete_picture'), 'class="btn btn-default"'); ?>
	<?php else : ?>
		
		<div class="accountPicSelect clearfix">
			<div class="pull-left">
				<input type="radio" name="pic_selection" value="custom" checked="true" />
				<?php echo showPhoto(); ?>
			</div>
			<div class="pull-left">
				<p><?php echo lang('profile_custom_upload_picture'); ?><br>
					<?php echo form_upload(array('name' => 'account_picture_upload', 'id' => 'account_picture_upload')); ?><br>
					<small>(<?php echo lang('profile_picture_guidelines'); ?>)</small>
				</p>
			</div>
		</div>

		<div class="accountPicSelect clearfix">
			<div class="pull-left">
				<input type="radio" name="pic_selection" value="gravatar" />
				<?php echo showPhoto( $gravatar ); ?>
			</div>
			<div class="pull-left">
				<p>
					<small><a href="http://gravatar.com/" target="_blank"><?php echo lang('gravatar'); ?></a></small>
				</p>
			</div>
		</div>
	
	<?php endif; ?>
</p>
	<?php if (isset($profile_picture_error))
	{
		echo '<span class="help-inline">' . $profile_picture_error . '</span>';
	} ?>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
	<button type="submit" class="btn btn-primary"><?php echo lang('profile_save'); ?></button>
    </div>
</div>

<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>