<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('users_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="span2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_users')); ?>
    </div>

    <div class="span10">

      <h2><?php echo lang("users_{$action}_page_name"); ?></h2>

      <div class="well">
        <?php echo lang("users_{$action}_description"); ?>
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="control-group <?php echo (form_error('settings_email') || isset($settings_email_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="settings_email"><?php echo lang('settings_email'); ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'settings_email', 'id' => 'settings_email', 'value' => set_value('settings_email') ? set_value('settings_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>
          <?php if (form_error('settings_email') || isset($settings_email_error))
        {
          ?>
              <span class="help-inline">
                <?php
            echo form_error('settings_email');
            echo isset($settings_email_error) ? $settings_email_error : '';
            ?>
                </span>
          <?php } ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('settings_fullname')) ? 'error' : ''; ?>">
          <label class="control-label" for="settings_fullname"><?php echo lang('settings_fullname'); ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'settings_fullname', 'id' => 'settings_fullname', 'value' => set_value('settings_fullname') ? set_value('settings_fullname') : (isset($update_account_details->fullname) ? $update_account_details->fullname : ''), 'maxlength' => 160)); ?>
          <?php if (form_error('settings_fullname'))
        {
          ?>
              <span class="help-inline">
                <?php echo form_error('settings_fullname'); ?>
                </span>
          <?php } ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('settings_firstname')) ? 'error' : ''; ?>">
          <label class="control-label" for="settings_firstname"><?php echo lang('settings_firstname'); ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'settings_firstname', 'id' => 'settings_firstname', 'value' => set_value('settings_firstname') ? set_value('settings_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('settings_firstname'))
        {
          ?>
              <span class="help-inline">
                <?php echo form_error('settings_firstname'); ?>
                </span>
          <?php } ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('settings_lastname')) ? 'error' : ''; ?>">
          <label class="control-label" for="settings_lastname"><?php echo lang('settings_lastname'); ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'settings_lastname', 'id' => 'settings_lastname', 'value' => set_value('settings_lastname') ? set_value('settings_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('settings_lastname'))
        {
          ?>
              <span class="help-inline">
                <?php echo form_error('settings_lastname'); ?>
                </span>
          <?php } ?>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="settings_lastname">Roles</label>

          <div class="controls">
            <label class="checkbox">
              <input type="checkbox" id="inlineCheckbox1" value="option1"> Admin
            </label>
            <label class="checkbox">
              <input type="checkbox" id="inlineCheckbox2" value="option2"> Website User
            </label>
          </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <a href="/account/manage_users" class="btn">Cancel</a>
      </div>

      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>