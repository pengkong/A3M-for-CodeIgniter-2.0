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
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_roles')); ?>
    </div>

    <div class="span10">

      <h2>Create Role</h2>

      <div class="well">
        Information about creating roles here...
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="control-group">
          <label class="control-label" for="role_name">Name</label>

          <div class="controls">
          <?php echo form_input(array('name' => 'role_name', 'id' => 'role_name', 'value' => '')); ?>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="settings_lastname">Permissions</label>

          <div class="controls">
            <label class="checkbox">
              <input type="checkbox" id="inlineCheckbox1" value="option1"> <span class="tip" data-toggle="tooltip" title="View existing roles">retrieve_roles</span>
            </label>
            <label class="checkbox">
              <input type="checkbox" id="inlineCheckbox2" value="option2"> <span class="tip" data-toggle="tooltip" title="Create new roles">create_roles</span>
            </label>
            <label class="checkbox">
              <input type="checkbox" id="inlineCheckbox2" value="option2"> <span class="tip" data-toggle="tooltip" title="Update existing permissions">update_permissions</span>
            </label>
          </div>
          <script>
            $('.tip').tooltip();
          </script>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <a href="/account/manage_roles" class="btn">Cancel</a>
      </div>

      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>