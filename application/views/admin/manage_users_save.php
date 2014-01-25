<div class="col-lg-12">
<div class="page-header">
  <h1><?php echo lang("users_{$action}_page_name"); ?></h1>
</div>

  <div class="well">
    <?php echo lang("users_{$action}_description"); ?>
  </div>

  <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

  <div class="form-group <?php echo (form_error('users_username') || isset($users_username_error)) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="users_username"><?php echo lang('profile_username'); ?></label>

      <div class="col-lg-10">
        <?php echo form_input(array('name' => 'users_username', 'id' => 'users_username', 'class' => 'form-control', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160));
        
        if (form_error('users_username') || isset($users_username_error))
        {
          echo form_error('users_username');
          echo isset($users_username_error) ? '<div class="alert alert-danger">' . $users_username_error . '</div>' : '';
        }?>
      </div>
  </div>

  <div class="form-group <?php echo (form_error('users_email') || isset($users_email_error)) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="users_email"><?php echo lang('settings_email'); ?></label>

      <div class="col-lg-10">
        <?php echo form_input(array('name' => 'users_email', 'id' => 'users_email', 'class' => 'form-control', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160));
        
        if (form_error('users_email') || isset($users_email_error))
        {
            echo form_error('users_email');
            echo isset($users_email_error) ? '<div class="alert alert-danger">' . $users_email_error . '</div>' : '';
        }?>
      </div>
  </div>

  <div class="form-group <?php echo (form_error('users_fullname')) ? 'error' : ''; ?>">
    <label class="control-label col-lg-2" for="users_fullname"><?php echo lang('settings_fullname'); ?></label>

    <div class="col-lg-10">
      <?php echo form_input(array('name' => 'users_fullname', 'id' => 'users_fullname', 'class' => 'form-control', 'value' => set_value('users_fullname') ? set_value('users_fullname') : (isset($update_account_details->fullname) ? $update_account_details->fullname : ''), 'maxlength' => 160));
      
      if (form_error('users_fullname'))
      {
        echo form_error('users_fullname');
      }?>
    </div>
  </div>

  <div class="form-group <?php echo (form_error('users_firstname')) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="users_firstname"><?php echo lang('settings_firstname'); ?></label>

      <div class="col-lg-10">
      <?php echo form_input(array('name' => 'users_firstname', 'id' => 'users_firstname', 'class' => 'form-control','value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80));
      
      if (form_error('users_firstname'))
      {
        echo form_error('users_firstname');
      } ?>
      </div>
  </div>

  <div class="form-group <?php echo (form_error('users_lastname')) ? 'error' : ''; ?>">
      <label class="control-label col-lg-2" for="users_lastname"><?php echo lang('settings_lastname'); ?></label>

      <div class="col-lg-10">
      <?php echo form_input(array('name' => 'users_lastname', 'id' => 'users_lastname', 'class' => 'form-control', 'value' => set_value('users_lastname') ? set_value('users_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80));
      
      if (form_error('users_lastname'))
      {
        echo form_error('users_lastname');
      }?>
      </div>
  </div>

  <div class="form-group <?php echo (form_error('users_new_password')) ? 'error' : ''; ?>">
    <label class="control-label col-lg-2" for="users_new_password"><?php echo lang('password_new_password'); ?></label>

    <div class="col-lg-10">
      <?php echo form_password(array('name' => 'users_new_password', 'id' => 'users_new_password', 'class' => 'form-control', 'value' => set_value('users_new_password'), 'autocomplete' => 'off'));
      
      if (form_error('users_new_password'))
      {
        echo form_error('users_new_password');
      } ?>
    </div>
  </div>

  <div class="form-group <?php echo (form_error('users_retype_new_password')) ? 'error' : ''; ?>">
    <label class="control-label col-lg-2" for="users_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

    <div class="col-lg-10">
      <?php echo form_password(array('name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'class' => 'form-control', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off'));
      
      if (form_error('users_retype_new_password'))
      {
        echo form_error('users_retype_new_password');
      } ?>
    </div>
  </div>

  <div class="form-group">
      <label class="control-label col-lg-2"><?php echo lang('users_roles'); ?></label>

      <div class="col-lg-10">
          <?php foreach($roles as $role) : ?>
            <?php 
            $check_it = FALSE;
            
            if( isset($update_account_roles) ) 
            {
              foreach($update_account_roles as $acrole) 
              {
                if($role->id == $acrole->id)
                {
                  $check_it = TRUE; break;
                }
              }
            }
            ?>
            <div class="checkbox">
              <label>
                <?php echo form_checkbox("account_role_{$role->id}", 'apply', $check_it, 'class="form-control"'); ?>
                <?php echo $role->name; ?>
              </label>
            </div>
            
          <?php endforeach; ?>
      </div>
  </div>
  
  <?php if($action === 'create'): ?>
  <div class="form-group">
    <?php echo form_label(lang('users_creation_send_info'), 'account_creation_info_send', array('class' => "control-label col-lg-2")); ?>
    <div class="col-lg-10">
      <div class="checkbox">
        <?php echo form_checkbox("account_creation_info_send", 'send', TRUE,'class="form-control"'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="form-group col-lg-offset-2 col-lg-10">
    <?php echo form_submit('manage_user_submit', lang('settings_save'), 'class="btn btn-primary"');
        echo anchor('admin/manage_users', lang('website_cancel'), 'class="btn btn-default"');
      if( $this->authorization->is_permitted('ban_users') && $action === 'update' )
      {
        echo '<span>' . lang('admin_or') . '</span>';
        if( isset($update_account->suspendedon) )
        {
          echo form_submit('manage_user_unban', lang('users_unban'), 'class="btn btn-danger"');
        }
        else
        {
          echo form_submit('manage_user_ban', lang('users_ban'), 'class="btn btn-danger"'); 
        }
      }
      
      if( $this->authorization->is_permitted('password_reset_users') && $action === 'update' )
      {
        echo '<span>' . lang('admin_or') . '</span>';
        if( ! $update_account->forceresetpass )
        {
          echo form_submit('force_reset_pass', lang('users_force_password_reset'), 'class="btn btn-warning"');
          echo "<small> ". lang('users_force_password_reset_notice') ."</small>";
        }
      }
    ?>
  </div>

  <?php echo form_close(); ?>

</div>