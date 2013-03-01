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

      <h2><?php echo lang('users_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('users_description'); ?>
      </div>

      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>
              <?php if( $this->authorization->is_permitted('create_users') ): ?>
                <a href="account/manage_users/save" class="btn btn-primary btn-small">Create<a>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>jdoe</td>
            <td>jdoe@email.com</td>
            <td>John</td>
            <td>Doresel</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_users/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>jrabbt <span class="label label-info">Admin</span></td>
            <td>jrabbt@email.com</td>
            <td>Jumpy</td>
            <td>Rabbit</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_users/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>btable</td>
            <td>btable@email.com</td>
            <td>Bobby</td>
            <td>Tables</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_users/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>