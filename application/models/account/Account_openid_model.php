<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_openid_model extends CI_Model {

	/**
	 * Get account openid
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account openid
	 */
	function get_by_account_id($account_id)
	{
		return $this->db->get_where('a3m_account_openid', array('account_id' => $account_id))->result();
	}

	// --------------------------------------------------------------------

	/**
	 * Get account openid
	 *
	 * @access public
	 * @param string $openid
	 * @return object account openid
	 */
	function get_by_openid($openid)
	{
		return $this->db->get_where('a3m_account_openid', array('openid' => $openid))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Insert account openid
	 *
	 * @access public
	 * @param string $openid
	 * @param int    $account_id
	 * @return void
	 */
	function insert($openid, $account_id)
	{
		$this->load->helper('date');

		if ( ! $this->get_by_openid($openid)) // ignore insert
		{
			$this->db->insert('a3m_account_openid', array('openid' => $openid, 'account_id' => $account_id, 'linkedon' => mdate('%Y-%m-%d %H:%i:%s', now())));
			return TRUE;
		}
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Delete account openid
	 *
	 * @access public
	 * @param string $openid
	 * @return void
	 */
	function delete($openid)
	{
		$this->db->delete('a3m_account_openid', array('openid' => $openid));
	}

}


/* End of file account_openid_model.php */
/* Location: ./application/account/models/account_openid_model.php */