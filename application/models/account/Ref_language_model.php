<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_language_model extends CI_Model {

	/**
	 * Get ref language
	 *
	 * @access public
	 * @param string $country
	 * @return object
	 */
	function get($country)
	{
		$this->db->where('one', $country);
		$this->db->or_where('two', $country);
		$this->db->or_where('language', $country);
		$query = $this->db->get('ref_language');
		if ($query->num_rows()) return $query->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get all ref language
	 *
	 * @access public
	 * @return object
	 */
	function get_all()
	{
		$this->db->order_by('language', 'asc');
		return $this->db->get('ref_language')->result();
	}

}


/* End of file ref_language_model.php */
/* Location: ./application/account/models/ref_language_model.php */