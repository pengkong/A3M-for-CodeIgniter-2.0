<div class="col-lg-12">
<div class="page-header">
  <h1><?php echo lang("permissions_{$action}_page_name"); ?></h1>
</div>

  <div class="well">
    <?php echo lang("permissions_{$action}_description"); ?>
  </div>

  <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

  <div class="form-group <?php echo (form_error('permission_key') || isset($permission_key_error)) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="permission_key"><?php echo lang('permissions_key'); ?></label>

      <div class="col-lg-10">
        <?php if( $is_system ) : ?>
          <?php echo form_hidden('permission_key', set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : '')); ?>

          <span class="input uneditable-input"><?php echo $permission->key; ?></span><span class="help-block"><?php echo lang('permissions_system_name'); ?></span>
        <?php else : ?>
          <?php echo form_input(array('name' => 'permission_key', 'id' => 'permission_key', 'class' => 'form-control', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : ''), 'maxlength' => 80)); ?>

          <?php if (form_error('permission_key') || isset($permission_key_error)) : ?>
            <span class="help-inline">
            <?php
              echo form_error('permission_key');
              echo isset($permission_key_error) ? $permission_key_error : '';
            ?>
            </span>
          <?php endif; ?>
        <?php endif; ?>
      </div>
  </div>

  <div class="form-group <?php echo form_error('permission_description') ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="permission_description"><?php echo lang('permissions_description'); ?></label>

      <div class="col-lg-10">
        <?php echo form_textarea(array('name' => 'permission_description', 'id' => 'permission_description', 'class' => 'form-control', 'value' => set_value('permission_description') ? set_value('permission_description') : (isset($permission->description) ? $permission->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

        <?php if (form_error('permission_description') || isset($permission_name_error))
        {
          echo form_error('permission_description');
        } ?>
      </div>
  </div>

  <div class="form-group">
      <label class="control-label col-lg-2"><?php echo lang('permissions_role'); ?></label>

      <div class="col-lg-10">
        <?php foreach( $roles as $role ) : ?>
          <?php
            $check_it = FALSE;

            if( isset($role_permissions) )
            {
              foreach( $role_permissions as $rperm )
              {
                if( $rperm->id == $role->id )
                {
                  $check_it = TRUE; break;
                }
              }
            }
          ?>
          <div class="checkbox">
            <label>
              <?php echo form_checkbox("role_permission_{$role->id}", 'apply', $check_it); ?>
              <?php echo $role->name; ?>
            </label>
          </div>
          
        <?php endforeach; ?>
      </div>
  </div>

  <div class="form-group col-lg-offset-2 col-lg-10">
    <?php echo form_submit('manage_permission_submit', lang('settings_save'), 'class="btn btn-primary"');
      echo anchor('admin/manage_permissions', lang('website_cancel'), 'class="btn btn-default"');
      if( $this->authorization->is_permitted('delete_permissions') && $action == 'update' && ! $is_system )
      {
        echo '<span>' . lang('admin_or') . '</span>';
        if( isset($permission->suspendedon) )
        {
          echo form_submit('manage_permission_unban', lang('permissions_unban'), 'class="btn btn-danger"');
        }
        else
        {
          echo form_submit('manage_permission_ban', lang('permissions_ban'), 'class="btn btn-danger"');
        }
      }?>
  </div>

  <?php echo form_close(); ?>

</div>