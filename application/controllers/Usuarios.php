<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador para la gestiòn de los Usuarios
class Usuarios extends CI_Controller {

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('modelos');
		 $this->load->model('usuarios');
	 }
	public function index()
	{
		$dt['bodega']= $this->modelos->BuscarBodega();
		$dt['estado']= $this->modelos->BuscarEstado();
		$this->load->view('welcome_message',$dt);
	}
	public function guardaUsuario($value='')
	{
		return "respuesta afirmativa";
	}
}
?>