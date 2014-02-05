<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Connect_create Controller
 */
class Connect_create extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/Account_model', 'account/Account_details_model', 'account/Account_providers_model'));
		$this->load->language(array('general', 'account/connect_third_party'));
	}

	/**
	 * Complete facebook's authentication process
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect user to home if sign ups are disabled
		if ( ! ($this->config->item("sign_up_enabled"))) redirect('');

		// Redirect user to home if 'connect_create' session data doesn't exist
		if ( ! $this->session->userdata('connect_create')) redirect('');

		$data['connect_create'] = $this->session->userdata('connect_create');

		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(array('field' => 'connect_create_username', 'label' => 'lang:connect_create_username', 'rules' => 'trim|required|alpha_numeric|min_length[2]|max_length[16]'), array('field' => 'connect_create_email', 'label' => 'lang:connect_create_email', 'rules' => 'trim|required|valid_email|max_length[160]')));

		// Run form validation
		if ($this->form_validation->run())
		{
			// Check if username already exist
			if ($this->username_check($this->input->post('connect_create_username', TRUE)) === TRUE)
			{
				$data['connect_create_username_error'] = lang('connect_create_username_taken');
			}
			// Check if email already exist
			elseif ($this->email_check($this->input->post('connect_create_email'), TRUE) === TRUE)
			{
				$data['connect_create_email_error'] = lang('connect_create_email_exist');
			}
			else
			{
				// Destroy 'connect_create' session data
				$this->session->unset_userdata('connect_create');

				// Create user
				$user_id = $this->Account_model->create($this->input->post('connect_create_username', TRUE), $this->input->post('connect_create_email', TRUE));
				//extract user details from $data['connect_create']
				//@todo 'dateofbirth' => 
				$provider = array_keys($data['connect_create'])[0];
				$user_details = array('firstname' => $data['connect_create']['firstName'], 'lastname' => $data['connect_create']['lastName'], 'gender' => $data['connect_create']['gender'], 'picture' => $data['connect_create']['photoURL']);
				
				// Add user details
				$this->Account_details_model->update($user_id, $user_details);

				// Connect third party account to user
				$this->Account_providers_model->insert($user_id, $provider);
				
				// Run sign in routine
				$this->authentication->sign_in_by_id($user_id);
			}
		}

		$data['content'] = $this->load->view('account/connect_create', isset($data) ? $data : NULL, TRUE);
		$this->load->view('template', $data);
	}

	/**
	 * Check if a username exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function username_check($username)
	{
		return $this->Account_model->get_by_username($username) ? TRUE : FALSE;
	}

	/**
	 * Check if an email exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function email_check($email)
	{
		return $this->Account_model->get_by_email($email) ? TRUE : FALSE;
	}

}

/* End of file Connect_create.php */
/* Location: ./application/controllers/account/Connect_create.php */
