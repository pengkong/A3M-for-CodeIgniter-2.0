<div class="col-lg-12">
<div class="page-header">
  <h2><?php echo lang('roles_page_name'); ?></h2>
</div>

  <div class="well">
    <?php echo lang('roles_page_description'); ?>
  </div>

  <table class="table table-condensed table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?php echo lang('roles_column_role'); ?></th>
        <th><?php echo lang('roles_column_users'); ?></th>
        <th><?php echo lang('roles_permission'); ?></th>
        <th>
          <?php if( $this->authorization->is_permitted('create_roles') ):
            echo anchor('admin/manage_roles/save', lang('website_create'), 'class="btn btn-primary btn-small"');
          endif; ?>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $roles as $role ) : ?>
        <tr>
          <td><?php echo $role['id']; ?></td>
          <td>
            <?php echo $role['name']; ?>
            <?php if( $role['is_disabled'] ): ?>
              <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?php if( $role['user_count'] > 0 ) :
              echo anchor('admin/manage_users/filter/role/'.$role['id'], $role['user_count'], 'class="badge badge-info"');
            else : ?>
              <span class="badge">0</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if( count($role['perm_list']) == 0 ) : ?>
              <span class="label"><?php echo lang('roles_permission_none'); ?></span>
            <?php else : ?>
              <ul class="inline">
                <?php foreach( $role['perm_list'] as $itm ) : ?>
                  <li><?php echo anchor('admin/manage_permissions/save/'.$itm['id'], $itm['key'], 'title="'.$itm['title'].'"'); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </td>
          <td>
            <?php if( $this->authorization->is_permitted('update_roles') ):
              echo anchor('admin/manage_roles/save/'.$role['id'], lang('website_update'), 'class="btn btn-default btn-small"');
            endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>