<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Connect Controller
 */
class Connect extends CI_Controller
{
    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();
        
        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url'));
        $this->load->library(array('account/Authentication', 'account/Authorization', 'account/Hybrid_auth_lib'));
        $this->load->model(array('account/Account_model', 'account/Account_details_model', 'account/Account_providers_model'));
        $this->load->language(array('general', 'account/connect_third_party'));
    }
    
    function Index($provider = NULL, $identifier = NULL)
    {
        // Enable SSL?
	maintain_ssl($this->config->item("ssl_enabled"));
        
        if(empty($provider))
        {
            if ($this->authentication->is_signed_in())
            {
                redirect('account/linked_accounts');
            }
            else
            {
                redirect('');
            }
        }
	
	//check if open id
	if($provider == "OpenID" && $identifier == NULL)
	{
	    //redirect to user to provide identifier
	    redirect('account/connect_openid');
	}
	
        try
        {
            if($this->hybrid_auth_lib->provider_enabled($provider))
            {
                log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
                
		if($identifier == NULL)
		{
		    $service = $this->hybrid_auth_lib->authenticate($provider);
		}
		else
		{
		    $service = $this->hybrid_auth_lib->authenticate($provider, array('openid_identifier' => $identifier));
		}
                
                if ($service->isUserConnected())
                {
                    log_message('debug', 'controller.HAuth.login: user authenticated.');
                    
                    $user_profile = $service->getUserProfile();
                    
                    log_message('debug', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
                    
		    //User has connected provider to A3M
                    if ($user = $this->Account_providers_model->get_by_provider_uid($provider, $user_profile->identifier)->user_id)
                    {
			if(! $this->authentication->is_signed_in())
			{
			    //user isn't signed in, so login
			    $this->authentication->sign_in_by_id($user);
			}
			else //otherwise this is an error and they are trying to connect already connected account
			{
			    $user === $this->session->userdata('account_id') ? $this->session->set_flashdata('linked_error', sprintf(lang('linked_linked_with_this_account'), lang('connect_facebook'))) : $this->session->set_flashdata('linked_error', sprintf(lang('linked_linked_with_another_account'), lang('connect_facebook')));
			    
			    redirect('account/linked_accounts');
			}
                    }
                    else
                    {
                        //if user is signed in then they are adding provider to their connected accounts
			if($this->authentication->is_signed_in())
			{
			    $this->Account_providers_model->insert($this->session->userdata('account_id'), $provider, $user_profile->identifier, $user_profile->email, $user_profile->displayName, $user_profile->firstName, $user_profile->lastName, $user_profile->profileURL, $user_profile->webSiteURL, $user_profile->photoURL);
			    
			    $this->session->set_flashdata('linked_info', sprintf(lang('linked_linked_with_your_account'), $provider));
			
			    redirect('account/linked_accounts');
			}
			// Discussion: should we compare the e-mails that we get with what we have on record and then connect with that?
			else //start creating a new account
			{
			    // Store user's data in session
			    $this->session->set_userdata('connect_create', array($provider => (array)$user_profile));
			    
			    // Create a3m account
			    redirect('account/connect_create');
			}
                    }
                }
                else // Cannot authenticate user
                {
                    show_error('Cannot authenticate user');
                }
            }
	    else
	    {
		show_404();
	    }
        }
        catch(Exception $e)
        {
            $error = 'Unexpected error';
            switch($e->getCode())
            {
                case 0 : $error = 'Unspecified error.'; break;
                case 1 : $error = 'Hybriauth configuration error.'; break;
                case 2 : $error = 'Provider not properly configured.'; break;
                case 3 : $error = 'Unknown or disabled provider.'; break;
                case 4 : $error = 'Missing provider application credentials.'; break;
                case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                        //redirect();
                        if (isset($service))
                        {
                            log_message('debug', 'controllers.HAuth.login: logging out from service.');
                            $service->logout();
                        }
                        show_error('User has cancelled the authentication or the provider refused the connection.');
                        break;
                case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                        break;
                case 7 : $error = 'User not connected to the provider.';
                        break;
		default : $error = 'Unspecified error.';
		    break;
            }
            
            if (isset($service))
            {
                $service->logout();
            }
            
            log_message('error', 'controllers.HAuth.login: '.$error);
            show_error('Error authenticating user.');
        }
    }
}
/* End of file Connect.php */
/* Location: ./application/controllers/account/Connect.php */