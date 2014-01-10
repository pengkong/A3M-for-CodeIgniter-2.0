<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Connect_end Controller
 */
class Connect_end extends CI_Controller
{
    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();
    }
    
    public function Index()
    {
        log_message('debug', 'controllers.HAuth.endpoint called.');
        log_message('debug', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));
        
	/*
	 * @todo fix for CodeIgnter
	 */
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
	    log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
	    $_GET = $_REQUEST;
        }
        
        log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
	
	//require_once APPPATH.'/helper/account/Hybrid/index.php';
	/*!
	* HybridAuth
	* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
	* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
	*/
	
	// ------------------------------------------------------------------------
	//	HybridAuth End Point
	// ------------------------------------------------------------------------
	
	require_once( APPPATH.'/third_party/Hybrid/Auth.php' );
	require_once( APPPATH.'/third_party/Hybrid/Endpoint.php' ); 
	
	Hybrid_Endpoint::process();
    }
    
}
/* End of file Connect_end.php */
/* Location: ./application/controllers/account/Connect_end.php */