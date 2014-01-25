<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Session Class
 *
 * Extends CI_Session with the following functionality:
 * Maintain all flashdata making them available to next request
 */ 
class MY_Session extends CI_Session {
	
	function __construct()
	{
	    parent::__construct();
	}

	/**
	 * Keeps existing flashdata available to next request.
	 *
	 * @access    public
	 * @param    string
	 * @return    void
	 */
	public function keep_flashdata($key = '')
	{
		// Mark individual flashdata as 'new' to preserve it from _flashdata_sweep()
		if ($key)
		{
			parent::keep_flashdata($key);
		}
		// Mark all 'old' flashdata as 'new' (keep data from being deleted during next request)
		else
		{
			$userdata = $this->userdata();
			foreach ($userdata as $name => $value)
			{
				$parts = explode(':old:', $name);
				if (is_array($parts) && count($parts) === 2)
				{
					$new_name = $this->flashdata_key.':new:'.$parts[1];
					$this->set_userdata($new_name, $value);
					$this->unset_userdata($name);
				}
			}
		}
	}

	// ------------------------------------------------------------------------

}


/* End of file MY_Session.php */
/* Location: ./application/libraries/Session/MY_Session.php */