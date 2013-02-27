<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {

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

	// --------------------------------------------------------------------

	/**
	 * Check user signin status
	 *
	 * @access public
	 * @return bool
	 */
	function is_signed_in()
	{
		return $this->CI->session->userdata('account_id') ? TRUE : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Sign user in
	 *
	 * @access public
	 * @param int  $account_id
	 * @param bool $remember
	 * @return void
	 */
	function sign_in($account_id, $remember = FALSE)
	{
		$remember ? $this->CI->session->cookie_monster(TRUE) : $this->CI->session->cookie_monster(FALSE);

		$this->CI->session->set_userdata('account_id', $account_id);

		$this->CI->load->model('account/account_model');

		$this->CI->account_model->update_last_signed_in_datetime($account_id);

		// Redirect signed in user with session redirect
		if ($redirect = $this->CI->session->userdata('sign_in_redirect'))
		{
			$this->CI->session->unset_userdata('sign_in_redirect');
			redirect($redirect);
		}
		// Redirect signed in user with GET continue
		elseif ($this->CI->input->get('continue'))
		{
			redirect($this->CI->input->get('continue'));
		}

		redirect('');
	}

	// --------------------------------------------------------------------

	/**
	 * Sign user out
	 *
	 * @access public
	 * @return void
	 */
	function sign_out()
	{
		$this->CI->session->unset_userdata('account_id');
	}

	// --------------------------------------------------------------------

	/**
	 * Check password validity
	 *
	 * @access public
	 * @param object $account
	 * @param string $password
	 * @return bool
	 */
	function check_password($password_hash, $password)
	{
		$this->CI->load->helper('account/phpass');

		$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

		return $hasher->CheckPassword($password, $password_hash) ? TRUE : FALSE;
	}

}


/* End of file Authentication.php */
/* Location: ./application/account/libraries/Authentication.php */