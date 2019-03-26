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
		$query = $this->db->query("SELECT * FROM tarea where $value");
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
	public function actualiza($table,$data,$id)
	{
		
		try{
			$this->db->where('id', $id);
			if ($this->db->update($table, $data)) {
				return "Tarea Actualizado";
			}else{
				return "Error al Actualiza";
			}
		}catch(Exception $e){
			return "Error: $e";
		}
        //return ;
	}
	public function elimina($id='')
	{
		try {
			if ($this->db->delete('tarea', array('id' => $id))){
				return "Tarea Eliminada";
			}
		} catch (Exception $e) {
			return "Error: $e";
		}
		 
	}
}
?>