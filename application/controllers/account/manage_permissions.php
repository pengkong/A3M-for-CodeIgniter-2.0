<?php
/*
 * Manage_permissions Controller
 */
class Manage_permissions extends CI_Controller {

  /**
   * Constructor
   */
  function __construct()
  {
    parent::__construct();

    // Load the necessary stuff...
    $this->load->config('account/account');
    $this->load->helper(array('date', 'language', 'account/ssl', 'url'));
    $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model'));
    $this->load->language(array('general', 'account/manage_permissions', 'account/account_settings', 'account/account_profile', 'account/sign_up', 'account/account_password'));
  }

  /**
   * Manage Permissions
   */
  function index()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_permissions'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_permissions'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all permossions, roles, and role_permissions
    $roles = $this->acl_role_model->get();
    $permissions = $this->acl_permission_model->get();
    $role_permissions = $this->rel_role_permission_model->get();

    // Combine all these elements for display
    $data['permissions'] = array();
    foreach( $permissions as $perm )
    {
      $current = array();
      $current['id'] = $perm->id;
      $current['key'] = $perm->key;
      $current['description'] = $perm->description;
      $current['role_list'] = array();
      $current['is_disabled'] = isset( $perm->suspendedon );

      foreach( $role_permissions as $rperm )
      {
        if( $rperm->permission_id == $perm->id )
        {
          foreach( $roles as $role )
          {
            if( $rperm->role_id == $role->id )
            {
              $current['role_list'][] = array(
                'id' => $role->id, 
                'name' => $role->name,
                'title' => $role->description );
            }
          }
        }
      }

      $data['permissions'][] = $current;
    }

    // Load manage permissions view
    $this->load->view('account/manage_permissions', $data);
  }


  /**
   * Manage Permissions
   */
  function save($id=null)
  {
    // Keep track if this is a new permission
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_permissions'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_permissions'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Set action type (create or update permission)
    $data['action'] = 'create';

    // Get all the roles
    $data['roles'] = $this->acl_role_model->get();

    // Is this a System Permission?
    $data['is_system'] = FALSE;

    //Get the role
    if( ! $is_new )
    {
      $data['permission'] = $this->acl_permission_model->get_by_id($id);
      $data['role_permissions'] = $this->rel_role_permission_model->get_by_permission_id($id);
      $data['action'] = 'update';
      $data['is_system'] = ($data['permission']->is_system == 1);
    }

    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'permission_key',
          'label' => 'lang:permissions_key',
          'rules' => 'trim|required|max_length[80]'),
        array(
          'field' => 'permission_description',
          'label' => 'lang:permissions_description',
          'rules' => 'trim|optional|max_length[160]')
      ));

    // Run form validation
    if ($this->form_validation->run())
    {
      
      $name_taken = $this->name_check($this->input->post('permission_key', TRUE));

      
      if ( (! empty($id) && strtolower($this->input->post('permission_key', TRUE)) != strtolower($data['permission']->key) && $name_taken) || (empty($id) && $name_taken) )
      {
        $data['permission_key_error'] = lang('permissions_name_taken');
      }
      else
      {
        // Create/Update role
        $attributes = array();

        // Not allowed to update keys for System Permissions
        if( ! $data['is_system'] )
        {
          $attributes['key'] = $this->input->post('permission_key', TRUE) ? $this->input->post('permission_key', TRUE) : NULL;
        }

        $attributes['description'] = $this->input->post('permission_description', TRUE) ? $this->input->post('permission_description', TRUE) : NULL;
        $id = $this->acl_permission_model->update($id, $attributes);
      

        // Check if the permission should be disabled
        if( $this->authorization->is_permitted('delete_permissions') ) 
        {
          if( $this->input->post('manage_permission_ban', TRUE) ) 
          {
            $this->acl_permission_model->update_suspended_datetime($id);
          }
          elseif( $this->input->post('manage_permission_unban', TRUE) )
          {
            $this->acl_permission_model->remove_suspended_datetime($id);
          }
        }

        // Apply to the checked roles
        $perms = array();
        foreach( $data['roles'] as $role )
        {
          if( $this->input->post("role_permission_{$role->id}", TRUE) )
          {
            $this->rel_role_permission_model->update($role->id, $id);
          }
          else
          {
            $this->rel_role_permission_model->delete($role->id, $id);
          }
        }

        redirect('account/manage_permissions');
      }
    }
    // Load manage permissions view
    $this->load->view('account/manage_permissions_save', $data);
  }

  /**
   * Check if the permission name exists
   *
   * @access public
   * @param string
   * @return bool
   */
  function name_check($permission_name)
  {
    return $this->acl_permission_model->get_by_name($permission_name) ? TRUE : FALSE;
  }
}

/* End of file manage_permissions.php */
/* Location: ./application/account/controllers/manage_permissions.php */
