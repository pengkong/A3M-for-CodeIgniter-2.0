<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('permissions_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="span2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_permissions')); ?>
    </div>

    <div class="span10">

      <h2><?php echo lang('permissions_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('permissions_description'); ?>
      </div>

      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Permission</th>
            <th>Description</th>
            <th>In Roles</th>
            <th>
              <?php if( $this->authorization->is_permitted('create_users') ): ?>
                <a href="account/manage_permissions/save" class="btn btn-primary btn-small">Create<a>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>create_roles</td>
            <td>Create new roles</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>retrieve_roles</td>
            <td>View existing roles</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>update_roles</td>
            <td>Update existing roles</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>4</td>
            <td>delete_roles</td>
            <td>Delete existing roles</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>5</td>
            <td>create_permissions</td>
            <td>Create new permissions</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>6</td>
            <td>retrieve_permissions</td>
            <td>View existing permissions</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>7</td>
            <td>update_permissions</td>
            <td>Update existing permissions</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>8</td>
            <td>delete_permissions</td>
            <td>Delete existing permissions</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>9</td>
            <td>create_users</td>
            <td>Create new users</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>10</td>
            <td>retrieve_users</td>
            <td>View existing users</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>11</td>
            <td>update_users</td>
            <td>Update existing users</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>12</td>
            <td>delete_users</td>
            <td>Delete existing users</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>13</td>
            <td>ban_users</td>
            <td>Ban and Unban existing users</td>
            <td>Admin</td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                <a href="account/manage_permissions/save/1" class="btn btn-small">Update<a>
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