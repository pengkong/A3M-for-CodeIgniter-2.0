<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook_lib {

	var $CI, $fb, $user;
	
	/**
	 * Constructor
	 */
    function __construct()
    {
		// Obtain a reference to the ci super object
		$this->CI =& get_instance();
		
        $this->CI->load->config('account/facebook');
		$this->CI->load->helper('account/facebook');
		
		// Require Facebook app keys to be configured
		if ( ! $this->CI->config->item('facebook_app_id') || ! $this->CI->config->item('facebook_secret'))
		{
			echo 'Visit '.anchor('http://www.facebook.com/developers/createapp.php', 'http://www.facebook.com/developers/createapp.php').' to create your app.'.
			'<br />The config file is located at "system\application\modules\account\config\facebook.php"';
			die;
		}
		
		// Create the Facebook object
		$this->fb = new Facebook(array(
			'appId' => $this->CI->config->item('facebook_app_id'),
			'secret' => $this->CI->config->item('facebook_secret'),
			'cookie' => true,
		));
		
		// Check for Facebook session
		if ($this->fb->getSession()) 
		{
			try 
			{
				// Check for expired session by making a api call
				$this->user = $this->fb->api('/me');
			} 
			catch (FacebookApiException $e) 
			{
				error_log($e);
			}
		}
	}
	
	// --------------------------------------------------------------------
	
}


/* End of file Facebook_lib.php */
/* Location: ./application/modules/account/libraries/Facebook_lib.php */