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
		
		//Load the session, if CI2 load it as library, if it is CI3 load as a driver
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->CI->load->library('session');
		}
		else
		{
			$this->CI->load->driver('session');
		}
		
		log_message('debug', 'Authentication Class Initalized');
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
	 * @param string  $username Username or e-mail
	 * @param string  $password
	 * @param bool $remember
	 * @return bool or string
	 */
	function sign_in($username, $password, $remember = FALSE)
	{
		// Get user by username / email
		$this->CI->load->model('account/Account_model');
		
		if ( ! $user = $this->CI->Account_model->get_by_username_email($username))
		{
			return FALSE;
		}
		else
		{
			$validation = $this->check_user_validation_suspend($user);
			if($validation != 'invalid' || $validation != 'suspended')
			{
				// Check password
				if ( ! $this->check_password($user->password, $password))
				{
					// Increment sign in failed attempts
					$this->CI->session->set_userdata('sign_in_failed_attempts', (int)$this->CI->session->userdata('sign_in_failed_attempts') + 1);
					
					return FALSE;
				}
				else
				{
					$this->sign_in_by_id($user->id, $remember);
				}
			}
			else
			{
				return $validation;
			}
		}
	}
	
	/**
	 * Sign user in by id
	 * Used for things like forgotten password, otherwise it should not be used
	 * as it doesn't do any checks on validity of the sign in.
	 *
	 * @access public
	 * @param int  $account_id
	 * @param bool $remember
	 * @return void
	 */
	function sign_in_by_id($account_id, $remember = FALSE)
	{
		// Clear sign in fail counter
		$this->CI->session->unset_userdata('sign_in_failed_attempts');
		
		//This needs more testing to make sure that is works properly as many changes were made to this due to CI3 upgrade
		$remember ? $this->CI->session->cookie->cookie_monster(TRUE) : $this->CI->session->cookie->cookie_monster(FALSE);
		
		$this->CI->session->set_userdata('account_id', $account_id);
		
		$this->CI->load->model('account/Account_model');
		
		$this->CI->Account_model->update_last_signed_in_datetime($account_id);
		
		//check if they need to reset password
		$account = $this->CI->Account_model->get_by_id($account_id);
		
		if($account->forceresetpass)
		{
			//redirect to password page
			redirect(base_url('account/password/'));
		}
		
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
		
		//change this URL for default redirect after sign in
		redirect(base_url());
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
		
		redirect('');
	}

	// --------------------------------------------------------------------

	/**
	 * Check password validity
	 *
	 * @access private
	 * @param string $password_hash
	 * @param string $password
	 * @return bool
	 */
	private function check_password($password_hash, $password)
	{
		$this->CI->load->helper('account/phpass');

		$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

		return $hasher->CheckPassword($password, $password_hash) ? TRUE : FALSE;
	}
	
	/**
	 * Check if user is allowed to sign in
	 * Checks if user has been suspended or hasn't validated their e-mail yet
	 *
	 * @access private
	 * @param object $account
	 * @return bool
	 */
	private function check_user_validation_suspend($account)
	{
		if($account->verifiedon === NULL && $this->CI->config->item('account_email_validation_required'))
		{
			return "invalid";
		}
		elseif($account->suspendedon != NULL)
		{
			return "suspended";
		}
		else
		{
			return TRUE;
		}
	}
}


/* End of file Authentication.php */
/* Location: ./application/account/libraries/Authentication.php */