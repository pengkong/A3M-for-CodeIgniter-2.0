<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('roles_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="span2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_roles')); ?>
    </div>

    <div class="span10">

      <h2><?php echo lang('roles_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('password_safe_guard_your_account'); ?>
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
      <?php echo form_fieldset(); ?>

        <!-- Manage Roles Form -->

      <?php echo form_fieldset_close(); ?>
      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>