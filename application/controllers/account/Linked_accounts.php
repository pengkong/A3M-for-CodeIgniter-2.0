<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Account_linked Controller
 */
class Linked_accounts extends CI_Controller {

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
		$this->load->model(array('account/Account_model', 'account/Account_providers_model', 'account/Account_facebook_model', 'account/Account_twitter_model', 'account/Account_openid_model', 'account/Account_linkedin_model'));
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
			redirect('account/sign_in/?continue='.urlencode(base_url('account/linked_accounts')));
		}

		// Retrieve sign in user
		$data['account'] = $this->Account_model->get_by_id($this->session->userdata('account_id'));
		
		/*
		 * Decaprated!
		 * Will be removed once a migration is made.
		 * Users are no longer able to login via these.
		 */
		
		// Delete a linked account
		if ($this->input->post('facebook_id') || $this->input->post('twitter_id') || $this->input->post('openid') || $this->input->post('linkedin_id'))
		{
			if ($this->input->post('facebook_id')) $this->Account_facebook_model->delete($this->input->post('facebook_id', TRUE));
			elseif ($this->input->post('twitter_id')) $this->Account_twitter_model->delete($this->input->post('twitter_id', TRUE));
			elseif ($this->input->post('openid')) $this->Account_openid_model->delete($this->input->post('openid', TRUE));
			elseif ($this->input->post('linkedin_id')) $this->Account_linkedin_model->delete($this->input->post('linkedin_id', TRUE));
			$this->session->set_flashdata('linked_info', lang('linked_linked_account_deleted'));
			redirect('account/linked_accounts');
		}

		// Check for linked accounts
		$data['num_of_linked_accounts'] = 0;

		// Get Facebook accounts
		if ($data['facebook_links'] = $this->Account_facebook_model->get_by_account_id($this->session->userdata('account_id')))
		{
			foreach ($data['facebook_links'] as $index => $facebook_link)
			{
				$data['num_of_linked_accounts'] ++;
			}
		}

		// Get Twitter accounts
		if ($data['twitter_links'] = $this->Account_twitter_model->get_by_account_id($this->session->userdata('account_id')))
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
		
		// Get Linkedin accounts
		if ($data['linkedin_links'] = $this->Account_linkedin_model->get_by_account_id($this->session->userdata('account_id')))
		{
			foreach ($data['linkedin_links'] as $index => $linkedin_link)
			{
				$data['num_of_linked_accounts'] ++;
			}
		}

		// Get OpenID accounts
		if ($data['openid_links'] = $this->Account_openid_model->get_by_account_id($this->session->userdata('account_id')))
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
		
		/*
		 * End of decaprated
		 */
		
		/*
		 * Here begins the new linked accounts
		 */
		//delete a linked account
		if ($this->input->post('provider') && $this->input->post('uid'))
		{
			$this->Account_providers_model->delete($this->session->userdata('account_id'), $this->input->post('provider', TRUE), $this->input->post('uid', TRUE));
			$this->session->set_flashdata('linked_info', lang('linked_linked_account_deleted'));
		}
		
		$data['linked_accounts'] = $this->Account_providers_model->get_by_user_id($this->session->userdata('account_id'));
		
		$data['content'] = $this->load->view('account/account_linked', $data, TRUE);
		$this->load->view('template', $data);
	}

}


/* End of file Connect_accounts.php */
/* Location: ./application/controllers/account/Connect_accounts.php */