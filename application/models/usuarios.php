<?php 
/**
 * 
 */
class Usuarios extends CI_Model
{
	
	function __construct()
	 {
		 parent::__construct();
		 
	 }

	public function find($value='')
	{
		$query = $this->db->query("SELECT * FROM usurios ");
		return $query->result();
	}
}
?>