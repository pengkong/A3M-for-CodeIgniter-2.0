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
        <?php echo lang('permissions_page_description'); ?>
      </div>

      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo lang('permissions_column_permission'); ?></th>
            <th><?php echo lang('permissions_description'); ?></th>
            <th><?php echo lang('permissions_column_inroles'); ?></th>
            <th>
              <?php if( $this->authorization->is_permitted('create_users') ): ?>
                <a href="account/manage_permissions/save" class="btn btn-primary btn-small">Create<a>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $permissions as $perm ) : ?>
            <tr>
              <td><?php echo $perm['id']; ?></td>
              <td>
                <?php echo $perm['key']; ?>
                <?php if( $perm['is_disabled'] ): ?>
                  <span class="label label-important"><?php echo lang('permissions_banned'); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo $perm['description']; ?></td>
              <td>
                <?php if( count($perm['role_list']) == 0 ) : ?>
                  <span class="label">None</span>
                <?php else : ?>
                  <ul class="inline">
                    <?php foreach( $perm['role_list'] as $itm ) : ?>
                      <li><?php echo anchor('account/manage_roles/save/'.$itm['id'], $itm['name'], 'title="'.$itm['title'].'"'); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $this->authorization->is_permitted('update_permissions') ): ?>
                  <?php echo anchor('account/manage_permissions/save/'.$perm['id'], lang('website_update'), 'class="btn btn-small"'); ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>