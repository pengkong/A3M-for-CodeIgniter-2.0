<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recaptcha {

	var $CI;

	/**
	 * Constructor
	 */
	function __construct()
	{
		// Obtain a reference to the ci super object
		$this->CI =& get_instance();

		// Load reCAPTCHA helper
		$this->CI->load->helper('account/recaptcha');

		// Load reCAPTCHA config
		$this->CI->config->load('account/recaptcha');
	}

	// --------------------------------------------------------------------

	/**
	 * Verify recaptcha submission if valid captcha pass is not found
	 *
	 * @access private
	 * @return mixed
	 */
	function check()
	{
		$response = FALSE;

		if ($this->CI->input->post('recaptcha_response_field'))
		{
			$recaptcha_private_key = $this->CI->config->item('recaptcha_private_key');
			$recaptcha_response = recaptcha_check_answer($recaptcha_private_key, $this->CI->input->ip_address(), $this->CI->input->post('recaptcha_challenge_field'), $this->CI->input->post('recaptcha_response_field'));
			$response = $recaptcha_response->is_valid ? TRUE : $recaptcha_response->error;
		}

		return $response;
	}

	// --------------------------------------------------------------------

	/**
	 * Load reCAPTCHA
	 *
	 * @access private
	 * @param string $error
	 * @param bool   $ssl
	 * @param string $theme
	 * @return string
	 */
	function load($error, $ssl = FALSE)
	{
		$recaptcha_public_key = $this->CI->config->item('recaptcha_public_key');
		$captcha = '<script type="text/javascript">var RecaptchaOptions = { theme : "'.$this->CI->config->item('recaptcha_theme').'" };</script>';
		$captcha .= recaptcha_get_html($recaptcha_public_key, $error, $ssl);

		return $captcha;
	}

}


/* End of file Recaptcha.php */
/* Location: ./application/account/libraries/Recaptcha.php */