<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SSL Helpers
 *
 * @author         Choy Peng Kong (pengkong@gmail.com)
 * @credit        Inspired by nevercraft - http://codeigniter.com/forums/viewthread/83154/#454992@package
 * @version        1.0
 * @license        MIT License Copyright (c) 2010
 */

// ------------------------------------------------------------------------

/**
 * Maintain SSL
 *
 * @access    public
 * @param    bool
 * @param    int
 * @return    void
 */
if ( ! function_exists('maintain_ssl'))
{
	function maintain_ssl($maintain = FALSE, $port = 443)
	{
		$CI =& get_instance();

		if ($maintain)
		{
			// remove protocol
			$segments = explode('://', $CI->config->config['base_url']);
			// explode url into segements
			$segments = explode('/', $segments[1]);
			// remove port number
			$domain = explode(':', $segments[0]);
			// form temp base url
			$temp_base_url = 'https://'.$domain[0].':'.$port.'/';
			// replace segments
			for ($i = 1; $i < sizeof($segments); $i ++) if ($segments[$i]) $temp_base_url .= $segments[$i].'/';
			// Temporarily overwrite base url
			$CI->config->config['base_url'] = $temp_base_url;
		}

		// if don't maintain but SSL is on -OR- maintain but SSL isn't on, correct by redirect
		if (( ! $maintain && ! empty($_SERVER['HTTPS'])) || ($maintain && empty($_SERVER['HTTPS'])))
		{
			// Keep flashdata - Requires MY_Session keep_flashdata()
			$CI->load->library('session');
			$CI->session->keep_flashdata();

			// Correct by redirect
			$CI->load->helper('url');
			header('Location: '.current_url().(empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING']));
		}
	}
}


/* End of file ssl_helper.php */
/* Location: ./application/account/helpers/ssl_helper.php */