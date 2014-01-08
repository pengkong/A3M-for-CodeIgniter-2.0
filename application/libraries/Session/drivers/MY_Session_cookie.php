<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Session Class
 *
 * Extends CI_Session with the following functionalities:
 *
 * 1) Ability to create a session that expire when the browser closes
 * 2) Prevent session loss when parallel requests are made using AJAX
 */ 
class MY_Session_cookie extends CI_Session_cookie {
	
	function __construct()
	{
	    parent::__construct();
	}
        
        // ------------------------------------------------------------------------

	/**
	 * Cookie Monster eats up the session cookie just before browser closes if he's awake!
	 *
	 * Okay, fine! It works by creating a cookie that tells CI_Session
	 * to create session cookies that expire when the browser closes
	 *
	 * @access    public
	 * @return    void
	 */
	public function cookie_monster($asleep)
	{
		$asleep ? $this->_setcookie($this->sess_cookie_name.'_cm', 'true', 0, $this->cookie_path, $this->cookie_domain, 0) : setcookie($this->sess_cookie_name.'_cm', 'false', 0, $this->cookie_path, $this->cookie_domain, 0);

		$_COOKIE[$this->sess_cookie_name.'_cm'] = $asleep ? 'true' : 'false';

		$this->sess_time_to_update = - 1;
		$this->_sess_update();
	}

	// ------------------------------------------------------------------------

	/**
	 * Write the session cookie
	 *
	 * @access    public
	 * @return    void
	 */
	public function _set_cookie($cookie_data = NULL)
	{
		// Get userdata (only defaults if database)
		$cookie_data = ($this->sess_use_database === TRUE)
				? array_intersect_key($this->userdata, $this->defaults)
				: $this->userdata;
		
		if (is_null($cookie_data))
		{
			$cookie_data = $this->userdata;
		}

		// Serialize the userdata for the cookie
		$cookie_data = serialize($cookie_data);

		if ($this->sess_encrypt_cookie === TRUE)
		{
			$cookie_data = $this->CI->encrypt->encode($cookie_data);
		}

		// Require message authentication
		$cookie_data .= hash_hmac('sha1', $cookie_data, $this->encryption_key);
		
		$expire = ($this->sess_expire_on_close === TRUE) ? 0 : $this->sess_expiration + time();

		// Set the cookie
		$this->_setcookie($this->sess_cookie_name, $cookie_data, // if cookie monster exist and is awake, generate a session cookie that expires on browser close
			isset($_COOKIE[$this->sess_cookie_name.'_cm']) && $_COOKIE[$this->sess_cookie_name.'_cm'] == 'false' ? 0 : $this->sess_expiration + time(), $this->cookie_path, $this->cookie_domain, $this->cookie_secure, $this->cookie_httponly);
	}

	// ------------------------------------------------------------------------
        
        /**
	 * Update an existing session
	 *
	 * @access    public
	 * @return    void
	 */
	public function _sess_update($force = FALSE)
	{
		// skip the session update if this is an AJAX call!
		if ( ! IS_AJAX)
		{
			parent::_sess_update($force);
		}
	}

	// ------------------------------------------------------------------------
        
}

/* End of file MY_Session.php */
/* Location: ./application/libraries/Session/drivers/MY_Session_cookie.php */