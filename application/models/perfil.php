<?php 
/**
 * 
 */
class Perfil extends CI_Model
{
	
	function __construct()
	 {
		 parent::__construct();
		 
	 }

	public function find($value='')
	{
		if ($value=="") {
			$value="1=1";
		}
		$query = $this->db->query("SELECT * FROM perfil where $value");
		return $query->result();
	}
}
?>