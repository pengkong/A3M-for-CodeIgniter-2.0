<?php
/*
 * Forgot_password Controller
 */
class Forgot_password extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'account/recaptcha', 'form_validation'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('general', 'account/forgot_password'));
	}

	/**
	 * Forgot password
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();

		// Store recaptcha pass in session so that users only needs to complete captcha once
		if ($recaptcha_result === TRUE) $this->session->set_userdata('forget_password_recaptcha_pass', TRUE);

		// Setup form validation
		// max length as per IETF (http://www.rfc-editor.org/errata_search.php?rfc=3696&eid=1690)
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'forgot_password_username_email',
				'label' => 'lang:forgot_password_username_email',
				'rules' => 'trim|required|min_length[2]|max_length[254]|callback_check_username_or_email'
			)
		));

		// Run form validation
		if ($this->form_validation->run())
		{
			// User has neither already passed recaptcha nor just passed recaptcha
			if ($this->session->userdata('forget_password_recaptcha_pass') != TRUE && $recaptcha_result !== TRUE && ($this->config->item("forgot_password_recaptcha_enabled") === TRUE))
			{
				$data['forgot_password_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('forgot_password_recaptcha_incorrect') : lang('forgot_password_recaptcha_required');
			}
			else
			{
				// Remove recaptcha pass
				$this->session->unset_userdata('forget_password_recaptcha_pass');

				// Username does not exist
				if ( ! $account = $this->account_model->get_by_username_email($this->input->post('forgot_password_username_email', TRUE)))
				{
					$data['forgot_password_username_email_error'] = lang('forgot_password_username_email_does_not_exist');
				}
				// Does not manage password
				elseif ( ! $account->password)
				{
					$data['forgot_password_username_email_error'] = lang('forgot_password_does_not_manage_password');
				}
				else
				{
					// Set reset datetime
					$time = $this->account_model->update_reset_sent_datetime($account->id);

					// Load email library
					$this->load->library('email');

					// Set up email preferences
					$config['mailtype'] = 'html';

					// Initialise email lib
					$this->email->initialize($config);

					// Generate reset password url
					$password_reset_url = site_url('account/reset_password?id='.$account->id.'&token='.sha1($account->id.$time.$this->config->item('password_reset_secret')));

					// Send reset password email
					$this->email->from($this->config->item('password_reset_email'), lang('reset_password_email_sender'));
					$this->email->to($account->email);
					$this->email->subject(lang('reset_password_email_subject'));
					$this->email->message($this->load->view('account/reset_password_email', array(
						'username' => $account->username,
						'password_reset_url' => anchor($password_reset_url, $password_reset_url)
					), TRUE));
					if($this->email->send())
					{
						// Load reset password sent view
						$this->load->view('account/reset_password_sent', isset($data) ? $data : NULL);
					}
					else
					{
						//if the email could not be sent it will display the error
						//should not happen if you have email configured correctly
						echo $this->email->print_debugger();
					}
					return;
				}
			}
		}

		// Load recaptcha code if recaptcha is enabled
		if ($this->config->item("forgot_password_recaptcha_enabled") === TRUE)
			if ($this->session->userdata('forget_password_recaptcha_pass') != TRUE)
				$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

		// Load forgot password view
		$this->load->view('account/forgot_password', isset($data) ? $data : NULL);
	}

	public function check_username_or_email($str)
	{
		//are we checking an email address?
		if (strpos($str,'@') !== false)
		{
			//Its an email, so lets check if its valid
			if ($this->form_validation->valid_email($str))
				return TRUE;
			else
			{
				$this->form_validation->set_message('check_username_or_email', 'Invalid e-mail address format');
				return FALSE;
			}
		}
		else
		{
			//check if username is alpha_dash
			if ($this->form_validation->alpha_dash($str))
				return TRUE;
			else
			{
				$this->form_validation->set_message('check_username_or_email', 'Invalid username format');
				return FALSE;
			}

		}

	}

}

/* End of file forgot_password.php */
/* Location: ./application/account/controllers/forgot_password.php */
