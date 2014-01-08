<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Connect_linkedin Controller
 */
class Connect_linkedin extends CI_Controller {
        
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url'));
        $this->load->library(array('account/authentication', 'account/authorization', 'account/linkedin_lib'));
        $this->load->model(array('account/Account_model', 'account/Account_linkedin_model', 'account/Account_details_model'));
        $this->load->language(array('general', 'account/sign_in', 'account/account_linked', 'account/connect_third_party'));
    }
    
    function index()
    {
        // Enable SSL?
	maintain_ssl($this->config->item("ssl_enabled"));
        
        //check if we are recieving errors
        if($this->input->get('error', TRUE))
        {
            echo "<strong>" . $this->input->get('error') . "</strong><br />" . $this->input->get('error_description');
            die;
        }
        elseif($this->input->get('code', TRUE)) //check if we are recieving information from linkedin or not
        {
            //now get access token
            $access_token = $this->linkedin_lib->li->getAccessToken($this->input->get('code', TRUE));
	    
            //get the user info
            $linkedin_info = $this->linkedin_lib->li->get('people/~:(id,first-name,last-name,picture-url,email-address)');
            
	    //check if the user already exists
	    if($linked_account = $this->Account_linkedin_model->get_by_linkedin_id($linkedin_info['id']))
	    {
		//user has already been registered so sign in
		$this->authentication->sign_in_by_id($linked_account->account_id);
	    }
	    else
	    {
		//check if the user is signed in
		if($this->authentication->is_signed_in())
		{
		    $account = $this->Account_model->get_by_id($this->session->userdata('account_id'));
		    //the user is signed in so just add the data into DB to connect the account
		    $this->Account_linkedin_model->insert($account->id, $linkedin_info['id']);
		    
		    //check if avatar is empty, if true put in the avatar from linkedin
		    $account_details = $this->Account_details_model->get_by_account_id($account->id);
		    if(is_null($account_details->picture))
		    {
			$this->Account_details_model->update($account->id, array('picture' => $linkedin_info['pictureUrl']));
		    }
		    
		    //now redirect to linked account
		    redirect('account/linked_accounts');
		}
		else
		{
		    // Store user's google data in session
		    $this->session->set_userdata('connect_create', array(array('provider' => 'linkedin', 'provider_id' => $linkedin_info['id'], 'email' => $twitter_info['emailAddress']), array('fullname' => $twitter_info['firstName'] . " " . $twitter_info['lastName'], 'picture' => $linkedin_info['pictureUrl'])));

		    // Create a3m account
		    redirect('account/connect_create');
		    
		}
	    }
        }
        else
        {
            // redirect user to authorize
            $authorization_url = $this->linkedin_lib->li->getLoginUrl(array('r_basicprofile', 'r_emailaddress'));
            redirect($authorization_url);
        }
    }
}