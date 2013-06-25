<?php
/*
 * Sign_in Controller
 */
class Sign_in extends CI_Controller {

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
		$this->load->language(array('account/sign_in', 'account/connect_third_party'));
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');

		// Set default recaptcha pass
		$recaptcha_pass = $this->session->userdata('sign_in_failed_attempts') < $this->config->item('sign_in_recaptcha_offset') ? TRUE : FALSE;

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();

		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'sign_in_username_email',
				'label' => 'lang:sign_in_username_email',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'sign_in_password',
				'label' => 'lang:sign_in_password',
				'rules' => 'trim|required'
			)
		));

		// Run form validation
		if ($this->form_validation->run() === TRUE)
		{
			// Get user by username / email
			if ( ! $user = $this->account_model->get_by_username_email($this->input->post('sign_in_username_email', TRUE)))
			{
				// Username / email doesn't exist
				$data['sign_in_username_email_error'] = lang('sign_in_username_email_does_not_exist');
			}
			else
			{
				// Either don't need to pass recaptcha or just passed recaptcha
				if ( ! ($recaptcha_pass === TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_in_recaptcha_enabled") === TRUE)
				{
					$data['sign_in_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_in_recaptcha_incorrect') : lang('sign_in_recaptcha_required');
				}
				else
				{
					// Check password
					if ( ! $this->authentication->check_password($user->password, $this->input->post('sign_in_password', TRUE)))
					{
						// Increment sign in failed attempts
						$this->session->set_userdata('sign_in_failed_attempts', (int)$this->session->userdata('sign_in_failed_attempts') + 1);

						$data['sign_in_error'] = lang('sign_in_combination_incorrect');
					}
					else
					{
						// Clear sign in fail counter
						$this->session->unset_userdata('sign_in_failed_attempts');

						// Run sign in routine
						$this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));
					}
				}
			}
		}

		// Load recaptcha code
		if ($this->config->item("sign_in_recaptcha_enabled") === TRUE)
			if ($this->config->item('sign_in_recaptcha_offset') <= $this->session->userdata('sign_in_failed_attempts'))
				$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

		// Load sign in view
		$this->load->view('sign_in', isset($data) ? $data : NULL);
	}

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */