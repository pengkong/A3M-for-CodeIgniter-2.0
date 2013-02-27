<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_twitter_model extends CI_Model {

	/**
	 * Get account twitter
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account twitter
	 */
	function get_by_account_id($account_id)
	{
		return $this->db->get_where('a3m_account_twitter', array('account_id' => $account_id))->result();
	}

	// --------------------------------------------------------------------

	/**
	 * Get account twitter
	 *
	 * @access public
	 * @param string $twitter_id
	 * @return object account twitter
	 */
	function get_by_twitter_id($twitter_id)
	{
		return $this->db->get_where('a3m_account_twitter', array('twitter_id' => $twitter_id))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Insert account twitter
	 *
	 * @access public
	 * @param int    $account_id
	 * @param int    $twitter_id
	 * @param string $oauth_token
	 * @param string $oauth_token_secret
	 * @return void
	 */
	function insert($account_id, $twitter_id, $oauth_token, $oauth_token_secret)
	{
		$this->load->helper('date');

		if ( ! $this->get_by_twitter_id($twitter_id)) // ignore insert
		{
			$this->db->insert('a3m_account_twitter', array('account_id' => $account_id, 'twitter_id' => $twitter_id, 'oauth_token' => $oauth_token, 'oauth_token_secret' => $oauth_token_secret, 'linkedon' => mdate('%Y-%m-%d %H:%i:%s', now())));
			return TRUE;
		}
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Delete account twitter
	 *
	 * @access public
	 * @param int $twitter_id
	 * @return void
	 */
	function delete($twitter_id)
	{
		$this->db->delete('a3m_account_twitter', array('twitter_id' => $twitter_id));
	}

}


/* End of file account_twitter_model.php */
/* Location: ./application/account/models/account_twitter_model.php */