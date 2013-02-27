<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_zoneinfo_model extends CI_Model {

	/**
	 * Get by zoneinfo
	 *
	 * @access public
	 * @param string $zoneinfo
	 * @return object
	 */
	function get_by_zoneinfo($zoneinfo)
	{
		$this->db->where('zoneinfo', $zoneinfo);
		$query = $this->db->get('ref_zoneinfo');
		if ($query->num_rows()) return $query->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Get by country
	 *
	 * @access public
	 * @param string $country
	 * @return object
	 */
	function get_by_country($country)
	{
		$this->db->where('country', $country);
		$query = $this->db->get('ref_zoneinfo');
		if ($query->num_rows()) return $query->result();
	}

	// --------------------------------------------------------------------

	/**
	 * Get all ref zoneinfo
	 *
	 * @access public
	 * @return object
	 */
	function get_all()
	{
		$this->db->order_by('zoneinfo', 'asc');
		return $this->db->get('ref_zoneinfo')->result();
	}

}


/* End of file ref_zoneinfo_model.php */
/* Location: ./application/account/models/ref_zoneinfo_model.php */