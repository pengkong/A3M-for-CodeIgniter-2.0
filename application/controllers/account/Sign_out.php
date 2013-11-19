<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Sign_out Controller
 */
class Sign_out extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url'));
		$this->load->config('account/account');
		$this->load->language(array('general', 'account/sign_out'));
		$this->load->library(array('account/authentication', 'account/authorization'));
	}

	// --------------------------------------------------------------------

	/**
	 * Account sign out
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect signed out users to homepage
		if ( ! $this->authentication->is_signed_in()) redirect('');
		
		// Run sign out routine
		$this->authentication->sign_out();
		
		// Redirect to homepage
		if ( ! $this->config->item("sign_out_view_enabled")) redirect('');
		
		// Load sign out view
		$data['content'] = $this->load->view('sign_out', '', TRUE);
		$this->load->view('template', $data);
	}

}


/* End of file Sign_out.php */
/* Location: ./application/controllers/account/Sign_out.php */