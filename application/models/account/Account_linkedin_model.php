<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_linkedin_model extends CI_Model {
    
    /*
     * Get account by id
     *
     * @access public
     * @param string $account_id
     * @return object account linkedin
     */
    function get_by_account_id($account_id)
    {
        return $this->db->get_where('a3m_account_linkedin', array('account_id' => $account_id))->result();
    }
    
    // --------------------------------------------------------------------
    
    /*
     * Get account by linkedin id
     *
     * @access public
     * @param string $linkedin_id
     * @return object account linkedin
     */
    function get_by_linkedin_id($linkedin_id)
    {
        return $this->db->get_where('a3m_account_linkedin', array('linkedin_id' => $linkedin_id))->row();
    }
    
    // --------------------------------------------------------------------
    
    /*
     * Insert linkedin account
     * @access public
     * @param int    $account_id
     * @param string $linkedin_id
     * @param string $oauth_token
     * @return boolean
     */
    function insert($account_id, $linkedin_id)
    {
        if ( ! $this->get_by_linkedin_id($linkedin_id)) // ignore insert
        {
            $this->load->helper('date');
            $this->db->insert('a3m_account_linkedin', array('account_id' => $account_id, 'linkedin_id' => $linkedin_id, 'linkedon' => mdate('%Y-%m-%d %H:%i:%s', now()) ));
	    return TRUE;
        }
        return FALSE;
    }
    
    // --------------------------------------------------------------------
    
    /*
     * Deletes given link
     * @access public
     * @param string $linkedin_id
     * @return void
     */
    function delete($linkedin_id)
    {
	$this->db->delete('a3m_account_linkedin', array('linkedin_id' => $linkedin_id));
    }
}