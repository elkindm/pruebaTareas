<?php 
/**
 * 
 */
class Tarea extends CI_Model
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
		$query = $this->db->query("SELECT * FROM usuario where $value");
		return $query->result();
	}

	 public function guardar($table,$data)
	{
		try{
			if ($this->db->insert($table,$data)) {
				return "Registro Guardado";
			}else{
				return "Error al Guardar";
			}
		}catch(Exception $e){
			return "Error: $e";
		}
		
	}
}
?>