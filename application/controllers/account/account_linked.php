<?php
/*
 * Account_linked Controller
 */
class Account_linked extends CI_Controller {

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
		$this->load->model(array('account/account_model', 'account/account_facebook_model', 'account/account_twitter_model', 'account/account_openid_model'));
		$this->load->language(array('general', 'account/account_linked', 'account/connect_third_party'));
	}

	/**
	 * Linked accounts
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'account/account_linked'));
		}

		// Retrieve sign in user
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		// Delete a linked account
		if ($this->input->post('facebook_id') || $this->input->post('twitter_id') || $this->input->post('openid'))
		{
			if ($this->input->post('facebook_id')) $this->account_facebook_model->delete($this->input->post('facebook_id', TRUE));
			elseif ($this->input->post('twitter_id')) $this->account_twitter_model->delete($this->input->post('twitter_id', TRUE));
			elseif ($this->input->post('openid')) $this->account_openid_model->delete($this->input->post('openid', TRUE));
			$this->session->set_flashdata('linked_info', lang('linked_linked_account_deleted'));
			redirect('account/account_linked');
		}

		// Check for linked accounts
		$data['num_of_linked_accounts'] = 0;

		// Get Facebook accounts
		if ($data['facebook_links'] = $this->account_facebook_model->get_by_account_id($this->session->userdata('account_id')))
		{
			foreach ($data['facebook_links'] as $index => $facebook_link)
			{
				$data['num_of_linked_accounts'] ++;
			}
		}

		// Get Twitter accounts
		if ($data['twitter_links'] = $this->account_twitter_model->get_by_account_id($this->session->userdata('account_id')))
		{
			$this->load->config('account/twitter');
			$this->load->helper('account/twitter');
			foreach ($data['twitter_links'] as $index => $twitter_link)
			{
				$data['num_of_linked_accounts'] ++;
				$epiTwitter = new EpiTwitter($this->config->item('twitter_consumer_key'), $this->config->item('twitter_consumer_secret'), $twitter_link->oauth_token, $twitter_link->oauth_token_secret);
				$data['twitter_links'][$index]->twitter = $epiTwitter->get_usersShow(array('user_id' => $twitter_link->twitter_id));
			}
		}

		// Get OpenID accounts
		if ($data['openid_links'] = $this->account_openid_model->get_by_account_id($this->session->userdata('account_id')))
		{
			foreach ($data['openid_links'] as $index => $openid_link)
			{
				if (strpos($openid_link->openid, 'google.com')) $data['openid_links'][$index]->provider = 'google';
				elseif (strpos($openid_link->openid, 'yahoo.com')) $data['openid_links'][$index]->provider = 'yahoo';
				elseif (strpos($openid_link->openid, 'myspace.com')) $data['openid_links'][$index]->provider = 'myspace';
				elseif (strpos($openid_link->openid, 'aol.com')) $data['openid_links'][$index]->provider = 'aol';
				else $data['openid_links'][$index]->provider = 'openid';

				$data['num_of_linked_accounts'] ++;
			}
		}

		$this->load->view('account/account_linked', $data);
	}

}


/* End of file account_linked.php */
/* Location: ./application/account/controllers/account_linked.php */