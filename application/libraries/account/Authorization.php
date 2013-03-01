<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization {

  var $CI;

  /**
   * Constructor
   */
  function __construct()
  {
    // Obtain a reference to the ci super object
    $this->CI =& get_instance();

    $this->CI->load->library('session');
  }

  /**
   * Check if user has permission
   *
   * @access public
   * @param array/string $permission_keys
   * @return bool
   */
  function is_permitted($permission_keys, $require_all = FALSE)
  {
    $account_id = $this->CI->session->userdata('account_id');

    $this->CI->load->model('account/acl_permission_model');

    $account_permissions = $this->CI->acl_permission_model->get_by_account_id($account_id);

    // Loop through and check if the account 
    // has any of the permission keys supplied
    if (isset($permission_keys))
    {
      foreach ($account_permissions as $perm) 
      {
        // Array of permission keys
        if (gettype($permission_keys) == 'array')
        {
          foreach ($permission_keys as $key) 
          {
            // Return if only a single one is required.
            if( $perm->key == $key && ! $require_all ) 
            {
              return TRUE;
            } 
            // Only takes one bad apple
            elseif ($perm->key != $key && $require_all)
            {
              return FALSE;
            }
          }
        }
        // Single permission key
        else
        {
          // Return if only a single one is required.
          if ($perm->key == $permission_keys && ! $require_all ) 
          {
            return TRUE;
          }
          // Only takes one bad apple
          elseif ($perm->key != $permission_keys && $require_all) 
          {
            return FALSE;
          }
        }
      }
    }

    // If nothing above matched for single 
    // permission, then this is false.
    if (! $require_all)
    {
      return FALSE;
    }
    // If it made this this far and all are 
    // required, then all is fine in the world
    else
    {
      return TRUE;
    }
  }
  
  // --------------------------------------------------------------------
  
  /**
   * Check if user has permission
   *
   * @access public
   * @param string $permission_key
   * @return bool
   */
  function is_admin()
  {
    $account_id = $this->CI->session->userdata('account_id');

    $this->CI->load->model('account/acl_role_model');

    return $this->CI->acl_role_model->has_role('Admin', $account_id);
  }

}


/* End of file Authorization.php */
/* Location: ./application/account/libraries/Authorization.php */

// --------------------------------------------------------------------
  
  