<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => lang('profile_page_name'))); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span2">
			<?php echo $this->load->view('account/account_menu', array('current' => 'account_profile')); ?>
        </div>
        <div class="span10">

			<?php if (isset($profile_info))
		{
			?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $profile_info; ?>
            </div>
			<?php } ?>

            <h2><?php echo lang('profile_page_name'); ?></h2>

            <div class="well"><?php echo lang('profile_instructions'); ?></div>

			<?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <div class="control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label" for="profile_username"><?php echo lang('profile_username'); ?></label>

                <div class="controls">
					<?php echo form_input(array('name' => 'profile_username', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24')); ?>
					<?php if (form_error('profile_username') || isset($profile_username_error))
				{
					?>
                    <span class="help-inline">
					<?php
						echo form_error('profile_username');
						echo isset($profile_username_error) ? $profile_username_error : '';
						?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label" for="profile_picture"><?php echo lang('profile_picture'); ?></label>

                <div class="controls">
                <p>
					<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
					<?php echo showPhoto($account_details->picture); ?> &nbsp;
					<?php echo anchor('account/account_profile/index/delete', '<i class="icon-trash"></i> '.lang('profile_delete_picture'), 'class="btn"'); ?>
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
									<small><a href="http://gravatar.com/" target="_blank">Gravatar</a></small>
								</p>
							</div>
						</div>
					
					<?php endif; ?>
                    </p>
					<?php if ( ! isset($account_details->picture)) : ?>
					<?php endif; ?>

					<?php if (isset($profile_picture_error))
				{
					?>
                    <span class="help-inline">
					<?php echo $profile_picture_error; ?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo lang('profile_save'); ?></button>
            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

        </div>
    </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>