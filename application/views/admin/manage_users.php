<div class="col-lg-12">
  <div class="page-header">
    <h1><?php echo lang('users_page_name'); ?></h1>
  </div>
  
  <div class="well">
    <?php echo lang('users_description'); ?>
  </div>

  <?php if( count($all_accounts) > 0 ) : ?>
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th><?php echo lang('users_username'); ?></th>
          <th><?php echo lang('settings_email'); ?></th>
          <th><?php echo lang('settings_firstname'); ?></th>
          <th><?php echo lang('settings_lastname'); ?></th>
          <th>
            <?php if( $this->authorization->is_permitted('create_users') ):
              echo anchor('admin/manage_users/save', lang('website_create'), array('class' => 'btn btn-primary btn-small'));
            endif; ?>
          </th>
        </tr>
      </thead>
      <tbody>

        <?php foreach( $all_accounts as $acc ) : ?>
          <tr>
            <td><?php echo $acc['id']; ?></td>
            <td>
              <?php echo $acc['username']; ?>
              <?php if( $acc['is_banned'] ): ?>
                <span class="label label-important"><?php echo lang('users_banned'); ?></span>
              <?php elseif( $acc['is_admin'] ): ?>
                <span class="label label-info"><?php echo lang('users_admin'); ?></span>
              <?php endif; ?>
            </td>
            <td><?php echo $acc['email']; ?></td>
            <td><?php echo $acc['firstname']; ?></td>
            <td><?php echo $acc['lastname']; ?></td>
            <td>
              <?php if( $this->authorization->is_permitted('update_users') ):
                echo anchor('admin/manage_users/save/'.$acc['id'], lang('website_update'), array('class' => 'btn btn-default btn-small'));
              endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  <?php endif; ?>
</div>