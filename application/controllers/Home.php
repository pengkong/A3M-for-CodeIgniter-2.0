<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model('account/Account_model');
	}

	function index()
	{
		maintain_ssl();
		
		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->Account_model->get_by_id($this->session->userdata('account_id'));
		}
		
		$data['content'] = $this->load->view('home', isset($data) ? $data : NULL, TRUE);
		$this->load->view('template', $data);
	}

}


/* End of file Home.php */
/* Location: ./system/application/controllers/Home.php */