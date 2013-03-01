<?php
/*
 * Manage_permissions Controller
 */
class Manage_permissions extends CI_Controller {

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
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model'));
    $this->load->language(array('general', 'account/manage_permissions'));
  }

  /**
   * Manage Permissions
   */
  function index()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_permissions'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_permissions'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Load manage permissions view
    $this->load->view('account/manage_permissions', $data);
  }
}

/* End of file manage_permissions.php */
/* Location: ./application/account/controllers/manage_permissions.php */
