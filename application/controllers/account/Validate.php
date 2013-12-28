<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Validate Controller
 */
class Validate extends CI_Controller {
    function __construct()
    {
	parent::__construct();
        
        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url'));
        $this->load->library(array('account/authentication', 'account/authorization'));
        $this->load->model('account/Account_model');
        $this->load->language(array('general', 'account/sign_up'));
    }
    
    /**
     * Validates account e-mail
     */
    function Index()
    {
        // Enable SSL?
	maintain_ssl($this->config->item("ssl_enabled"));
        
        // Redirect signed in users to homepage
        if($this->config->item('account_email_validation_required'))
	{
	    if ($this->authentication->is_signed_in()) redirect('');
	}
        
        //redirect invalid entries to homepage
        if($this->input->get('user_id', TRUE) == NULL && $this->input->get('token', TRUE) == NULL) redirect('');
        
        $account = $this->Account_model->get_by_id($this->input->get('user_id', TRUE));
	
        //check for valid token
        if($this->input->get('token', TRUE) == sha1($account->id . $account->createdon . $this->config->item('password_reset_secret')))
        {
            //activate
            $this->Account_model->verify($account->id);
            
            //load the confirmation page
            $data['content'] = $this->load->view('account/account_validation', isset($data) ? $data : NULL, TRUE);
	    $this->load->view('template', $data);
        }
        else
        {
            redirect('');
        }
    }
}

/* End of file Validate.php */
/* Location: ./application/controllers/account/Validate.php */