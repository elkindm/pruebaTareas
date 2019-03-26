<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador para la gestiòn de los Usuarios
class Usuarios extends CI_Controller {

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('modelos');
		 $this->load->model('usuario');
	 }
	public function index()
	{
		$dt['bodega']= $this->modelos->BuscarBodega();
		$dt['estado']= $this->modelos->BuscarEstado();
		$this->load->view('welcome_message',$dt);
	}
	public function editar($value='')
	{
		$usuario = $this->input->post('id');
		$res= $this->usuario->find("usuario='$usuario'");
		$respuesta=array();
		foreach ($res as $key) {
			$respuesta['usuario']=$key->usuario;
			$respuesta['clave']=$key->clave;
			$respuesta['confirma']=$key->confirmaClave;
			$respuesta['numeroIdentificacion']=$key->numeroIdentificacion;
			$respuesta['primerNombre']=$key->primerNombre;
			$respuesta['segundoNombre']=$key->segundoNombre;
			$respuesta['primerApellido']=$key->primerApellido;
			$respuesta['segundoApellido']=$key->segundoApellido;
			$respuesta['estado']=$key->estado;
			$respuesta['perfil']=$key->perfil;
		}
		echo json_encode($respuesta);
	}
	public function guardaUsuario($value='')
	{
		$usuario = $this->input->post('usuario'); 
		$pass = $this->input->post('pass'); 
		$cpass = $this->input->post('cpass'); 
		$identificacion = $this->input->post('identificacion'); 
		$pnom = $this->input->post('pnom'); 
		$snom = $this->input->post('snom'); 
		$pape = $this->input->post('pape'); 
		$sape = $this->input->post('sape'); 
		$estado = $this->input->post('estado');
		$permiso = $this->input->post('permiso');
		$feha=Date('Y-m-d'); 
		//consultar si exite el usuario
			$res= $this->usuario->find("usuario='$usuario'");

			if (count($res)>0) {
				//actualiza
				$tabla="usuario";
				$data = array(
				 
				 'clave' => $pass,
				 'confirmaClave' => $cpass,
				 'numeroIdentificacion' => $identificacion,
				 'primerNombre' => $pnom,
				 'segundoNombre' => $snom,
				 'primerApellido' => $pape,
				 'segundoApellido' => $sape,
				 'estado' => $estado,
				 'fechaEstado' => $feha,
				 'perfil' => $permiso,
				);
				$respuesta = $this->usuario->actualiza($tabla, $data,$usuario);
			}else{
				//crea registro
				$tabla="usuario";
				$data = array(
				 'usuario' => $usuario,
				 'clave' => $pass,
				 'confirmaClave' => $cpass,
				 'numeroIdentificacion' => $identificacion,
				 'primerNombre' => $pnom,
				 'segundoNombre' => $snom,
				 'primerApellido' => $pape,
				 'segundoApellido' => $sape,
				 'estado' => $estado,
				 'fechaEstado' => $feha,
				 'perfil' => $permiso,
				);
			
			$respuesta = $this->usuario->guardar($tabla, $data );
			}
		echo json_encode($respuesta);
	}
	public function elimina($value='')
	{
		$id = $this->input->post('id'); 
		$respuesta = $this->usuario->elimina($id);
		echo json_encode($respuesta);
	}
	public function buscar($value='')
	{
		$dato = $this->input->post('dato');
		if ($dato=="") {
			$res= $this->usuario->find();
		}else{
			$res= $this->usuario->find("usuario like '%$dato%' or primerNombre like '%$dato%' or primerApellido like '%$dato%' or estado like '%$dato%' or perfil like '%$dato%' ");
		}
		
		$respuesta='';
		$dt['tabla']="<table class='table table-bordered '>
				<thead class='thead-dark'>
					<tr>
						<th>Usuario</th>
						<th>Nombres</th>
						<th>Estado</th>
						<th>Perfil</th>
						<th><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#crearProducto'><b>+</b> Agregar Usuario</button></th>
						
					</tr>
				</thead>
				<tbody>";
		foreach ($res as $key) {
			$estado="";

		      				$perfils="";
		      				switch ($key->estado) {
		      					case 'A':
		      						$estado="Activo";
		      						break;
		      					case 'I':
		      						$estado="Inactivo";
		      						break;
		      					
		      					default:
		      						# code...
		      						break;
		      				}
		      				switch ($key->perfil) {
		      					case '1':
		      						$perfils="Sistemas";
		      						break;
		      					case '2':
		      						$perfils="Administrador";
		      						break;
		      					case '3':
		      						$perfils="Operador";
		      						break;
		      					case '4':
		      						$perfils="Auditor";
		      						break;
		      					
		      					default:
		      						# code...
		      						break;
		      				}
			$dt['tabla'].="<tr ondblclick='editar(".$key->usuario.")' title='Doble clic para editar' style='cursor: pointer;'>";
		      		$dt['tabla'].="<td>{$key->usuario}</td>";
		      		$dt['tabla'].="<td>".$key->primerNombre." ".$key->primerApellido."</td>";
		      		$dt['tabla'].="<td> ".$key->estado."</td>";
		      		$dt['tabla'].="<td>". $key->perfil."</td>";
		      		$dt['tabla'].="<td><button class='btn btn-danger' onclick='elimina($key->usuario>)'>Eliminar</button></td>";
		      					
		    $dt['tabla'].="</tr>";
			//$respuesta.="<tr>";
		}
		$dt['tabla'].="<tbody></table>";
		echo json_encode($dt);
	}
}
?>