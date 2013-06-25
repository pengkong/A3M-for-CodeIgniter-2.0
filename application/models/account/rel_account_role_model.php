<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_account_role_model extends CI_Model {

  /**
   * Get all account roles
   *
   * @access public
   * @return object all account permissions
   */
  function get()
  {
    return $this->db->get('a3m_rel_account_role')->result();
  }

  /**
   * Get roles by account id
   *
   * @access public
   * @param int $account_id
   * @return object account details object
   */
  function get_by_account_id($account_id)
  {
    $this->db->select('a3m_acl_role.*');
    $this->db->from('a3m_rel_account_role');
    $this->db->join('a3m_acl_role', 'a3m_rel_account_role_model.role_id = a3m_acl_role.id');
    $this->db->where("a3m_rel_account_role_model.account_id = $account_id AND a3m_acl_role.suspendedon IS NULL");

    return $this->db->get()->result();
  }

  /**
   * Check if account already has this role assigned
   *
   * @access public
   * @param int $account_id
   * @param int $role_id
   * @return object account details object
   */
  function exists($account_id, $role_id) 
  {
    $this->db->from('a3m_rel_account_role');
    $this->db->where('account_id', $account_id);
    $this->db->where('role_id', $role_id);

    return ( $this->db->count_all_results() > 0 );
  }

  // --------------------------------------------------------------------
  
  /**
   * Create a new account role
   *
   * @access public
   * @param int $account_id
   * @param int $role_id
   * @return void
   */
  function update($account_id, $role_id)
  {
    // Insert
    if (!$this->exists($account_id, $role_id))
    {
      $this->db->insert('a3m_rel_account_role', array('account_id' => $account_id, 'role_id' => $role_id));
    }
  }

  /**
   * Batch update account roles.
   *
   * @access public
   * @param int $account_id
   * @param array $role_ids
   * @return void
   */
  function update_batch($account_id, $role_ids)
  {
    // Blank array, then no insert for you
    if( count($role_ids) > 0)
    {
      // Create a new batch
      $batch = array();
      foreach($role_ids as $role_id)
      {
        $batch[] = array(
          'account_id' => $account_id,
          'role_id' => $role_id
          );
      }

      // Insert all the new roles
      $this->db->insert_batch('a3m_rel_account_role', $batch);
    }
  }

  /**
   * Delete all current roles and replace with array of roles passed in.
   *
   * @access public
   * @param int $account_id
   * @param array $role_ids
   * @return void
   */
  function delete_update_batch($account_id, $role_ids)
  {
    // Delete all current roles
    $this->delete_by_account($account_id);

    // Batch update the account roles
    $this->update_batch($account_id, $role_ids);
  }

  /**
   * Delete single instance by account/role
   *
   * @access public
   * @param int $account_id
   * @param int $role_id
   * @return void
   */
  function delete($account_id, $role_id)
  {
    $this->db->delete('a3m_rel_account_role', array('account_id' => $account_id, 'role_id' => $role_id));
  }



  /**
   * Delete all roles for account
   *
   * @access public
   * @param int $account_id
   * @return void
   */
  function delete_by_account($account_id)
  {
    $this->db->delete('a3m_rel_account_role', array('account_id' => $account_id));
  }



  /**
   * Delete all by roles id
   *
   * @access public
   * @param int $role_id
   * @return void
   */
  function delete_by_role($role_id)
  {
    $this->db->delete('a3m_rel_account_role', array('role_id' => $role_id));
  }
}