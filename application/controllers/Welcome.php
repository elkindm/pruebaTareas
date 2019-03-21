<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador que gestiona las plantillas de la aplicaciòn
class Welcome extends CI_Controller {

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('modelos');
	 }
	public function index()//login
	{
		/*$dt['bodega']= $this->modelos->BuscarBodega();
		$dt['estado']= $this->modelos->BuscarEstado();*/
		//$this->load->view('encabezado/head');
		$this->load->view('contenido/inicio');
		$this->load->view('piedepagina/foother');
	}

	public function usuarios()
	{
		$this->load->view('encabezado/head');
		$this->load->view('contenido/usuarios');
		$this->load->view('piedepagina/foother');
	}

	public function tareas($value='')
	{
		$this->load->view('encabezado/head');
		$this->load->view('contenido/tareas');
		$this->load->view('piedepagina/foother');
	}
	
	public function buscar()
	{
		$productos= $this->modelos->Buscar();
		$dt['tabla']="<table class='table table-bordered '>
				<thead>
					<tr>
						<th>Producto</th>
						<th>Bodega</th>
						<th>Cantidad</th>
						<th>Estado</th>
						<th>Gestión</th>
						
					</tr>
				</thead>
				<tbody>";
				foreach ($productos as $ke) {
					$bodega= $this->modelos->BuscarBodegaid($ke->bodega);
					$estado= $this->modelos->BuscarEstadoid($ke->estado);
					$dt['tabla'].="<tr>";
						$dt['tabla'].="<td>".$ke->nombre."</td>";
						$dt['tabla'].="<td>".$bodega."</td>";
						$dt['tabla'].="<td>".$ke->cantidad."</td>";
						if ($ke->estado=='0') {
							$bg="bg-danger";
						}else{
							$bg="bg-success";
						}
						$dt['tabla'].="<td class='$bg text-white' >".$estado."</td>";
						$dt['tabla'].="<td><button type='button' onclick='cambiarEstado($ke->referencia)' class='btn btn-default' >Cambiar Estado Estado</button></td>";
						
					$dt['tabla'].="</tr>";
				}
			$dt['tabla'].="</tbody>
				</table>";
		echo json_encode($dt);
	}
	public function buscarn()
	{
		$nombre = $this->input->post('producto'); 
		$productos= $this->modelos->Buscarn($nombre);
		$dt['tabla']="<table class='table table-bordered '>
				<thead>
					<tr>
						<th>Producto</th>
						<th>Bodega</th>
						<th>Cantidad</th>
						<th>Estado</th>
						<th>Gestión</th>
						
					</tr>
				</thead>
				<tbody>";
				foreach ($productos as $ke) {
					$bodega= $this->modelos->BuscarBodegaid($ke->bodega);
					$estado= $this->modelos->BuscarEstadoid($ke->estado);
					$dt['tabla'].="<tr>";
						$dt['tabla'].="<td>".$ke->nombre."</td>";
						$dt['tabla'].="<td>".$bodega."</td>";
						$dt['tabla'].="<td>".$ke->cantidad."</td>";
						if ($ke->estado=='0') {
							$bg="bg-danger";
						}else{
							$bg="bg-success";
						}
						$dt['tabla'].="<td class='$bg text-white' >".$estado."</td>";
						$dt['tabla'].="<td><button type='button' onclick='cambiarEstado($ke->referencia)' class='btn btn-default' >Cambiar Estado Estado</button></td>";
						
					$dt['tabla'].="</tr>";
				}
			$dt['tabla'].="</tbody>
				</table>";
		echo json_encode($dt);
	}
	
		public function guradaProducto()
		{
			$nombre = $this->input->post('nombre'); 
			$cantidad = $this->input->post('cantidad'); 
			$estado = $this->input->post('estado'); 
			$bodega = $this->input->post('bodega');
			$observaciones = $this->input->post('observaciones'); 
			
			$tabla="clientes";
			$data = array(
			 'nombre' => $nombre,
			 'bodega' => $bodega,
			 'cantidad' => $cantidad,
			 'estado' => $estado,
			 'observaciones' => $observaciones,
			 
			 
			);
			
			$nueva_insercion = $this->modelos->guardar("productos", $data );
			$dt['bodega']= $this->modelos->BuscarBodega();
			$dt['estado']= $this->modelos->BuscarEstado();
			$this->load->view('welcome_message',$dt);
			//print_r($nueva_insercion);
			/*$msg['msg']=$nueva_insercion;
			$this->load->view('solicitud',$msg);*/
		}
	
		public function cambiarEstado()
		{
			$id = $this->input->post('id'); 
			$estado= $this->modelos->Buscarid($id);
			
			if ($estado==0) {
				$estado=1;
			}else{
				$estado=0;
			}
			$data = array(
			 'estado' => $estado,
			 
			);
			
			
			$nueva_insercion = $this->modelos->actualiza("productos", $data,$id);
			$dt['bodega']= $this->modelos->BuscarBodega();
			$dt['estado']= $this->modelos->BuscarEstado();
			$this->load->view('welcome_message',$dt);
		}
		
	

}
