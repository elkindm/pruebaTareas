<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controlador para la gestiòn de las tareas
class Tareas extends CI_Controller {

	function __construct()
	 {
		 parent::__construct();
		 $this->load->model('modelos');
	 }
	public function index()
	{
		$dt['bodega']= $this->modelos->BuscarBodega();
		$dt['estado']= $this->modelos->BuscarEstado();
		$this->load->view('welcome_message',$dt);
	}
}
?>