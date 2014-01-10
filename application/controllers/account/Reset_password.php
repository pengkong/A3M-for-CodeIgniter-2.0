<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Reset_password Controller
 */
class Reset_password extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('date', 'language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'account/recaptcha', 'form_validation'));
		$this->load->model('account/Account_model');
		$this->load->language(array('general', 'account/reset_password'));
	}

	/**
	 * Reset password
	 */
	function index($id=null)
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();

		// User has not passed recaptcha + check that it is really needed
		if (($recaptcha_result !== TRUE) && ($this->config->item("forgot_password_recaptcha_enabled") === TRUE))
		{
			if ($this->input->post('recaptcha_challenge_field'))
			{
				$data['reset_password_recaptcha_error'] = $recaptcha_result ? lang('reset_password_recaptcha_incorrect') : lang('reset_password_recaptcha_required');
			}
			
			// Load recaptcha code
			$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

			// Load reset password captcha view
			$data['content'] = $this->load->view('account/reset_password_captcha', isset($data) ? $data : NULL, TRUE);
			$this->load->view('template', $data);
			return;
		}

		// Get account by email
		if ($account = $this->Account_model->get_by_id($this->input->get('id')))
		{
			// Check if reset password has expired
			if (now() < (strtotime($account->resetsenton) + $this->config->item("password_reset_expiration")))
			{
				// Check if token is valid
				if ($this->input->get('token', TRUE) == sha1($account->id.strtotime($account->resetsenton).$this->config->item('password_reset_secret')))
				{
					// Remove reset sent on datetime
					$this->Account_model->remove_reset_sent_datetime($account->id);

					// Upon sign in, redirect to change password page
					$this->session->set_userdata('sign_in_redirect', 'account/password');

					// Run sign in routine
					$this->authentication->sign_in_by_id($account->id);
				}
			}
		}

		// Load reset password unsuccessful view
		$data['content'] = $this->load->view('account/reset_password_unsuccessful', isset($data) ? $data : NULL, TRUE);
		$this->load->view('template', $data);
	}

}


/* End of file Reset_password.php */
/* Location: ./application/controllers/account/Reset_password.php */
