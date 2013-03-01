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
        <?php echo lang('roles_description'); ?>
      </div>

      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Role</th>
            <th>Users</th>
            <th>Permissions</th>
            <th>
              <?php if( $this->authorization->is_permitted('create_users') ): ?>
                <a href="account/manage_roles/save" class="btn btn-primary btn-small">Create<a>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Admin</td>
            <td><a href="/account/manage_users/filter/role/1" class="badge badge-info">1</a></td>
            <td>
              create_roles, retrieve_roles, update_roles, delete_roles,<br/>
              create_permissions, retrieve_permissions, update_permissions, delete_permissions,<br/>
              create_users, retrieve_users, update_users, delete_users,<br/>
              ban_users
            </td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_roles/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Website User</td>
            <td><span class="badge">0</span></td>
            <td>No Permissions</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_roles/save/1" class="btn btn-small">Update<a>
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