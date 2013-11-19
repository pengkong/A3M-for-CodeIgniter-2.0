<div class="col-lg-12">
  <div class="page-header">
    <h1><?php echo lang("roles_{$action}_page_name"); ?></h1>
  </div>

  <div class="well">
    <?php echo lang("roles_{$action}_description"); ?>
  </div>

  <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

  <div class="form-group <?php echo (form_error('role_name') || isset($role_name_error)) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="role_name"><?php echo lang('roles_name'); ?></label>

      <div class="col-lg-10">
        <?php if( $is_system ) : ?>
          <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

          <span class="input uneditable-input"><?php echo $role->name; ?></span><span class="help-block"><?php echo lang('roles_system_name'); ?></span>
        <?php else : ?>
          <?php echo form_input(array('name' => 'role_name', 'id' => 'role_name', 'class' => 'form-control', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

          <?php if (form_error('role_name') || isset($role_name_error)) : ?>
            <span class="help-inline">
            <?php
              echo form_error('role_name');
              echo isset($role_name_error) ? $role_name_error : '';
            ?>
            </span>
          <?php endif; ?>
        <?php endif; ?>
      </div>
  </div>

  <div class="form-group <?php echo form_error('role_description') ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="role_description"><?php echo lang('roles_description'); ?></label>

      <div class="col-lg-10">
        <?php echo form_textarea(array('name' => 'role_description', 'id' => 'role_description', 'class' => 'form-control', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

        <?php if (form_error('role_description') || isset($role_name_error)) : ?>
          <span class="help-inline">
          <?php
            echo form_error('role_description');
          ?>
          </span>
        <?php endif; ?>
      </div>
  </div>

  <div class="form-group">
      <label class="control-label col-lg-2"><?php echo lang('roles_permission'); ?></label>

      <div class="col-lg-10">
        <?php foreach( $permissions as $perm ) : ?>
          <?php
            $check_it = FALSE;
            
            if( isset($role_permissions) )
            {
              foreach( $role_permissions as $rperm )
              {
                if( $rperm->id == $perm->id )
                {
                  $check_it = TRUE; break;
                }
              }
            }
          ?>
          <div class="checkbox">
            <label>
              <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'class="form-control"'); ?>
              <?php echo $perm->key; ?>
            </label>
          </div>
          
        <?php endforeach; ?>
      </div>
  </div>

  <div class="form-actions col-lg-offset-2 col-lg-10">
    <?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary"');
            echo anchor('admin/manage_roles', lang('website_cancel'), 'class="btn btn-default"');
      if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ){
        echo '<span>' . lang('admin_or') . '</span>';
        if( isset($role->suspendedon) ){
          echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger"');
        } else {
          echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger"');
        }
      } ?>
  </div>

  <?php echo form_close(); ?>

</div>