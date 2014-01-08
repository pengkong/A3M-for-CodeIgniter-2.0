<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Linkedin_lib
{
    
    var $CI, $li, $user;
    
    /**
    * Constructor
    */
    function __construct()
    {
        //Obtain CI refference
        $this->CI =& get_instance();
        
        $this->CI->load->config('account/linkedin');
        $this->CI->load->helper('account/linkedin');
        
        //Require APP keys to be configured
        if ( ! $this->CI->config->item('linkedin_api_key') || ! $this->CI->config->item('linkedin_secret_key'))
        {
            echo 'Visit '.anchor('https://www.linkedin.com/secure/developer', 'https://www.linkedin.com/secure/developer').' to create your app.'.'<br />The config file is located at "/application/config/account/linkedin.php"';
	    die;
        }
        
        //Create linkedin object
        $this->li = new Linkedin(array('api_key' => $this->CI->config->item('linkedin_api_key'), 'api_secret' => $this->CI->config->item('linkedin_secret_key'), 'callback_url' => base_url('account/connect_linkedin')));
    }
}

/* End of file Linkedin_lib.php */
/* Location: ./application/account/libraries/Linkedin_lib.php */