<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador que gestiona las plantillas de la aplicaciòn
class Welcome extends CI_Controller {
	

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('usuario');
		 $this->load->model('tarea');
		 $this->load->model('perfil');
		 
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
		$dt['session']=($this->session);
		$max= $this->usuario->max('usuario');
		$dt['musuario']=$max[0];
		//$dt['usuarios']= $this->usuario->find();
		$dt['perfil']= $this->perfil->find();
		
		if ($this->session->userData('perfil')!="OPERADOR") {
			$dt['error']="";
			
		}else{
			$dt['error']="El usuario no tiene los permisos para esta vista";
		}
		$this->load->view('encabezado/head');
		$this->load->view('contenido/usuarios',$dt);
		$this->load->view('piedepagina/foother');
	}

	public function home($value='')
	{
		
		$usuario = $this->input->post('usuario'); 
		$pass = $this->input->post('pass'); 
		$usuario= $this->usuario->find("usuario = '$usuario' and clave='$pass'");
		$nombre="";
		if (count($usuario)>0) {

			$nombre=$usuario[0]->primerNombre;
			$perfil=$usuario[0]->perfil;
			$data=array(
				'usuario'=>$usuario,
				'nombre'=>$nombre,
				'perfil'=>$perfil,
				'login'=>true
			);
			$this->session->set_userData($data);
			//echo $this->session->userData('nombre');
			$respuesta['ruta']=base_url()."Welcome/tareas";
			echo json_encode($respuesta);
			/*$respuesta['ruta']="<?php echo base_url().'Welcome/tareas' ?>";
			/*$respuesta['text']=" ¡Bienbenidos al sistema!";
			$respuesta['icon']="success";*/
		}else{
			$respuesta['ruta']="";
			$respuesta['text']="Error: ¡usuario y contraseña incorrecta!";
			$respuesta['icon']="error";
			echo json_encode($respuesta);
			
		}
		
	}

	public function tareas($value='')
	{
		$dt['usuarios']= $this->usuario->find();
		$dt['session']=($this->session);
		$this->load->view('encabezado/head');
			$this->load->view('contenido/tareas',$dt);
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
