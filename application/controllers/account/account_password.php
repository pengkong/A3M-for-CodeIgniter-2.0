<?php
/*
 * Account_password Controller
 */
class Account_password extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('date', 'language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('general', 'account/account_password'));
	}

	/**
	 * Account password
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'account/account_password'));
		}

		// Retrieve sign in user
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		// No access to users without a password
		if ( ! $data['account']->password) redirect('');

		### Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(array('field' => 'password_new_password', 'label' => 'lang:password_new_password', 'rules' => 'trim|required|min_length[6]'), array('field' => 'password_retype_new_password', 'label' => 'lang:password_retype_new_password', 'rules' => 'trim|required|matches[password_new_password]')));

		### Run form validation
		if ($this->form_validation->run())
		{
			// Change user's password
			$this->account_model->update_password($data['account']->id, $this->input->post('password_new_password', TRUE));
			$this->session->set_flashdata('password_info', lang('password_password_has_been_changed'));
			redirect('account/account_password');
		}

		$this->load->view('account/account_password', $data);
	}

}


/* End of file account_password.php */
/* Location: ./application/account/controllers/account_password.php */