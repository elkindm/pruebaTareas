<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador para la gestiòn de las tareas
class Tareas extends CI_Controller {

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('tarea');
	 }
	/*public function index()
	{
		$dt['bodega']= $this->modelos->BuscarBodega();
		$dt['estado']= $this->modelos->BuscarEstado();
		$this->load->view('welcome_message',$dt);
	}*/
	public function actualizar($value='')
	{
		$usuario ="";
		foreach ($this->session->userData('usuario') as $value) {
			$usuario=($value->usuario);
		}
		$id = $this->input->post('ids');
		$titulo = $this->input->post('titulos'); 
		$desc = $this->input->post('descs'); 
		$fechaVencimiento = $this->input->post('fechaVencimientos'); 
		$estado = $this->input->post('finTareas'); 
		
		$fecha=Date('Y-m-d'); 
		//consultar si exite el usuario
			$res= $this->tarea->find("id='$id'");

			if (count($res)>0) {
				//actualiza
				$tabla="tarea";
				$data = array(
				 
				 'fechaRegistro' => $fecha,
				 'titulo' => $titulo,
				 'descripcion' => $desc,
				 'estado' => $estado,
				 'fechaVencimiento' => $fechaVencimiento,
				 'usuario' => $usuario,
				 
				);
				$respuesta = $this->tarea->actualiza($tabla, $data,$id);
			}
		echo json_encode($respuesta);
	}
	public function crear($value='')
	{
		$usuario ="";
		foreach ($this->session->userData('usuario') as $value) {
			$usuario=($value->usuario);
		}
		
		$titulo = $this->input->post('titulo'); 
		$desc = $this->input->post('desc'); 
		$fechaVencimiento = $this->input->post('fechaVencimiento'); 
		$estado = $this->input->post('finTarea'); 
		
		$fecha=Date('Y-m-d'); 
		//consultar si exite el usuario
		//$res= $this->tarea->find();
				//crea registro
				$tabla="tarea";
				$data = array(
				 'fechaRegistro' => $fecha,
				 'titulo' => $titulo,
				 'descripcion' => $desc,
				 'estado' => $estado,
				 'fechaVencimiento' => $fechaVencimiento,
				 'usuario' => $usuario,
				);
			
			$respuesta = $this->tarea->guardar($tabla, $data );
			
		echo json_encode($respuesta);
	}
	public function editar($value='')
	{
		$id = $this->input->post('id');
		$res= $this->tarea->find("id='$id'");
		$respuesta=array();
		foreach ($res as $key) {
			$respuesta['id']=$key->id;
			$respuesta['fechaVencimiento']=$key->fechaVencimiento;
			$respuesta['titulo']=$key->titulo;
			$respuesta['descripcion']=$key->descripcion;
			$respuesta['estado']=$key->estado;
			
		}
		echo json_encode($respuesta);
	}
	public function buscar()
	{
		$codicion="";
		$usuario ="";
		$respuesta='';
		foreach ($this->session->userData('usuario') as $value) {
			$usuario=($value->usuario);
		}
		//$dato = $this->input->post('dato');
		$respuesta='';
		$dato=$this->uri->segment(3);
		$est=$this->uri->segment(4);
		$us=$this->uri->segment(5);
		$orde=$this->uri->segment(6);
		$respuesta['segm']=$this->uri->segment(3);
		if ($dato!="false") {

			$codicion="fechaRegistro like '%$dato%' or titulo like '%$dato%' or descripcion like '%$dato%' or fechaVencimiento like '%$dato%'";
			//$res= $this->tarea->find();
		}
		 if ($est!="false"){
			if ($codicion=="") {
				$codicion=$codicion." estado ='$est'";
			}else{
				$codicion=$codicion." and estado ='$est'";	
			}
			
			//$res= $this->tarea->find("usuario like '%$dato%' or primerNombre like '%$dato%' or primerApellido like '%$dato%' or estado like '%$dato%' or perfil like '%$dato%' ");
		}
		 if ($us!="false"){
			
			if ($codicion=="") {
				$codicion=$codicion." usuario ='$us'";
			}else{
				$codicion=$codicion." and usuario ='$us'";
			}
			
		}
		if ($orde!="false"){
			
			if ($codicion=="") {
				$codicion=$codicion."1=1 order by fechaVencimiento $orde ";
			}else{
				$codicion=$codicion." and usuario ='$us'";
			}
			
		}

		$res= $this->tarea->find($codicion);
		
		$respuesta['sql']=$codicion;
		$respuesta['tabla']="<div class='list-group' align='left'>";
		foreach ($res as $key) {
			if ($usuario==$key->usuario) {
				$btn="<button type='button' onclick='elimina({$key->id})' class='btn btn-danger'>Eliminar tarea</button>";
				$accion="ondblclick='editar(".$key->id.")'";
			}else{
				$btn="";
				$accion="";
			}
			$estado='';
			switch ($key->estado) {
				case 'si':
					$estado='text-success';
					break;
				case 'NO':
					$estado='text-danger';
					break;
				default:
					# code...
					break;
			}
			$respuesta['tabla'].="<a href='#' $accion  class='list-group-item list-group-item-action ' title='doble clic para editar la tarea'>
				    <div class='d-flex w-100 justify-content-between'>
				      <h5 class='mb-1'>{$key->titulo}</h5>
				      <small>Fecha de Vencimiento: {$key->fechaVencimiento}</small>
				    </div>
				    <samp>{$key->descripcion}</samp>
				    
				    <div class='row'>
				    	<div class='col'>
				    		<small >Autor: {$key->usuario}  {$key->fechaRegistro}</small>
				    	</div>
				    	<div class='col' align='center'>
				    		<small >Tarea Finalizada: <h5 class='$estado'>{$key->estado}</h5> </small>
				    	</div>
				    	<div class='col' align='center'>
				    		<small >$btn</small>
				    	</div>
				    </div>
			  </a>";
		}
		$respuesta['tabla'].="</div>";
		echo json_encode($respuesta);
	}
	public function borrar($value='')
	{
		$id = $this->input->post('id'); 
		$respuesta = $this->tarea->elimina($id);
		echo json_encode($respuesta);
	}
}
?>