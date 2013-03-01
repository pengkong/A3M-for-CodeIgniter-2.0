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
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_permissions')); ?>
    </div>

    <div class="span10">

      <h2>Create Permission</h2>

      <div class="well">
        Information about creating permissions here...
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="control-group">
          <label class="control-label" for="permission_name">Name</label>

          <div class="controls">
          <?php echo form_input(array('name' => 'permission_name', 'id' => 'permission_name', 'value' => '')); ?>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="permission_description">Description</label>

          <div class="controls">
          <?php echo form_textarea(array('name' => 'permission_description', 'id' => 'permission_description', 'value' => '', 'maxlength' => 160)); ?>
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
        <a href="/account/manage_permissions" class="btn">Cancel</a>
      </div>

      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>