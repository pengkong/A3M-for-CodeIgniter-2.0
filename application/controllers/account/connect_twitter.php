<?php
/*
 * Connect_twitter Controller
 */
class Connect_twitter extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'account/twitter_lib'));
		$this->load->model(array('account/account_model', 'account/account_twitter_model'));
		$this->load->language(array('general', 'account/sign_in', 'account/account_linked', 'account/connect_third_party'));
	}

	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		if ($this->input->get('oauth_token'))
		{
			try
			{
				// Perform token exchange
				$this->twitter_lib->etw->setToken($this->input->get('oauth_token'));
				$twitter_token = $this->twitter_lib->etw->getAccessToken();
				$this->twitter_lib->etw->setToken($twitter_token->oauth_token, $twitter_token->oauth_token_secret);

				// Get account credentials
				$twitter_info = $this->twitter_lib->etw->get_accountVerify_credentials()->response;
			} catch (Exception $e)
			{
				$this->authentication->is_signed_in() ? redirect('account/account_linked') : redirect('account/sign_up');
			}

			// Check if user has connect twitter to a3m
			if ($user = $this->account_twitter_model->get_by_twitter_id($twitter_info['id']))
			{
				// Check if user is not signed in on a3m
				if ( ! $this->authentication->is_signed_in())
				{
					// Run sign in routine
					$this->authentication->sign_in($user->account_id);
				}
				$user->account_id === $this->session->userdata('account_id') ? $this->session->set_flashdata('linked_error', sprintf(lang('linked_linked_with_this_account'), lang('connect_twitter'))) : $this->session->set_flashdata('linked_error', sprintf(lang('linked_linked_with_another_account'), lang('connect_twitter')));
				redirect('account/account_linked');
			}
			// The user has not connect twitter to a3m
			else
			{
				// Check if user is signed in on a3m
				if ( ! $this->authentication->is_signed_in())
				{
					// Store user's twitter data in session
					$this->session->set_userdata('connect_create', array(array('provider' => 'twitter', 'provider_id' => $twitter_info['id'], 'username' => $twitter_info['screen_name'], 'token' => $twitter_token->oauth_token, 'secret' => $twitter_token->oauth_token_secret), array('fullname' => $twitter_info['name'], 'picture' => $twitter_info['profile_image_url'])));

					// Create a3m account
					redirect('account/connect_create');
				}
				else
				{
					// Connect twitter to a3m
					$this->account_twitter_model->insert($this->session->userdata('account_id'), $twitter_info['id'], $twitter_token->oauth_token, $twitter_token->oauth_token_secret);
					$this->session->set_flashdata('linked_info', sprintf(lang('linked_linked_with_your_account'), lang('connect_twitter')));
					redirect('account/account_linked');
				}
			}
		}

		// Redirect to authorize url
		header("Location: ".$this->twitter_lib->etw->getAuthenticateUrl());
	}

}


/* End of file connect_twitter.php */
/* Location: ./application/controllers/account/connect_twitter.php */
