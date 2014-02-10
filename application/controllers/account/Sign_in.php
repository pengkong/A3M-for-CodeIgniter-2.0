<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
		$this->load->model('account/Account_model');
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
		if ($this->authentication->is_signed_in()) redirect(base_url());

		// Set default recaptcha pass
		$recaptcha_pass = $this->session->userdata('sign_in_failed_attempts') < $this->config->item('sign_in_recaptcha_offset') ? TRUE : FALSE;

		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();

		// Setup form validation
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
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
		if ($this->form_validation->run())
		{
			// Either don't need to pass recaptcha or just passed recaptcha
			if ( ! ($recaptcha_pass === TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_in_recaptcha_enabled") === TRUE)
			{
				$data['sign_in_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_in_recaptcha_incorrect') : lang('sign_in_recaptcha_required');
			}
			else
			{
				// Authenticate
				if( ! $sign_in_error = $this->authentication->sign_in($this->input->post('sign_in_username_email', TRUE), $this->input->post('sign_in_password', TRUE), $this->input->post('sign_in_remember', TRUE)))
				{
					if($sign_in_error === "invalid")
					{
						//show login error
						$data['sign_in_error'] = lang('sign_in_non_validated_email');
						
					}
					elseif($sign_in_error === "suspended")
					{
						//show login error
						$data['sign_in_error'] = lang('sign_in_suspended_account');
					}
					else
					{
						//show login error
						$data['sign_in_error'] = lang('sign_in_combination_incorrect');
					}
				}
			}
		}
		
		// Load recaptcha code
		if ($this->config->item("sign_in_recaptcha_enabled") === TRUE)
			if ($this->config->item('sign_in_recaptcha_offset') <= $this->session->userdata('sign_in_failed_attempts'))
				$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));
			
		// Load sign in view
		$data['content'] = $this->load->view('sign_in', isset($data) ? $data : NULL, TRUE);
		$this->load->view('template', $data);
	}
}
/* End of file Sign_in.php */
/* Location: ./application/controllers/account/Sign_in.php */