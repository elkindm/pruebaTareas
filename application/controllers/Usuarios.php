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
				$respuesta = $this->modelos->actualiza($tabla, $data,$usuario);
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
		echo json_encode($respuesta." ".count($res));
	}
}
?>