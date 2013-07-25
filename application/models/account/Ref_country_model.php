<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_country_model extends CI_Model {

	/**
	 * Get ref country
	 *
	 * @access public
	 * @param string $country
	 * @return object
	 */
	function get($country)
	{
		$this->db->where('alpha2', $country);
		$this->db->or_where('alpha3', $country);
		$this->db->or_where('numeric', $country);
		$this->db->or_where('country', $country);
		$query = $this->db->get('ref_country');
		if ($query->num_rows()) return $query->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get all ref countries
	 *
	 * @access public
	 * @return object
	 */
	function get_all()
	{
		$this->db->order_by('country', 'asc');
		return $this->db->get('ref_country')->result();
	}

}


/* End of file ref_country_model.php */
/* Location: ./application/account/models/ref_country_model.php */