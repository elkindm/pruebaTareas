<?php 
/**
 * 
 */
class Modelos extends CI_Model
{
	
	function __construct()
	 {
		 parent::__construct();
		 
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
			$this->db->where('referencia', $id);
			if ($this->db->update($table, $data)) {
				return "Crédito Aprobado";
			}else{
				return "Error al Aprobar el crédito";
			}
		}catch(Exception $e){
			return "Error: $e";
		}
        return ;
	}
	public function Buscar()
	{
		$query = $this->db->query("SELECT * FROM productos ");
		return $query->result();
	}
	public function Buscarn($nombre)
	{
		$query = $this->db->query("SELECT * FROM productos where nombre like '$$nombre'");
		return $query->result();
	}
	public function Buscarid($id)
	{
		$query = $this->db->query("SELECT * FROM productos where referencia='$id'");
		$valor="";
		foreach ($query->result() as $key) {
			$valor= $key->estado;
		}
		return $valor;
	}
	public function BuscarBodega()
	{
		$query = $this->db->query("SELECT * FROM bodegas ");
		return $query->result();
	}
	public function BuscarEstado()
	{
		$query = $this->db->query("SELECT * FROM estado ");
		return $query->result();
	}

	public function BuscarBodegaid($id)
	{
		$query = $this->db->query("SELECT * FROM bodegas where codigo='$id'");
		$valor="";
		foreach ($query->result() as $key) {
			$valor= $key->detalle;
		}
		return $valor;
	}
	public function BuscarEstadoid($id)
	{
		$query = $this->db->query("SELECT * FROM estado where codigo='$id' ");
		$valor="";
		foreach ($query->result() as $key) {
			$valor= $key->detalle;
		}
		return $valor;
	}
	public function Buscarcre($id)
	{
		$query = $this->db->query("SELECT * FROM creditos where id_credito='$id'");
		$valor="";
		foreach ($query->result() as $key) {
			$valor= $key->valor_credito;
		}
		return $query->result();
	}
	public function saldo($id)
	{
		$query = $this->db->query("SELECT * FROM abonos WHERE creditos_id_credito ='$id' ORDER BY fecha_abono  DESC limit 1");
		
		return $query->result();
	}
	public function abonos($id)
	{
		$query = $this->db->query("SELECT * FROM abonos WHERE creditos_id_credito ='$id' ORDER BY fecha_abono  DESC ");

		
		return $query->result();
	}
}
?>
