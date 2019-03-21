<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Prueba</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <script src="http://localhost/pruebaTareas/bootstrap/js/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="http://localhost/pruebaTareas/bootstrap/css/bootstrap.css">
	
	<script src="http://localhost/pruebaTareas/bootstrap/js/bootstrap.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
</head>
<body>
<div class="jumbotron">
  <h1>Prueba App Tareas</h1> 
  
</div>
<div class="container" align="center">

	<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
	  <div class="card-header">Iniciar Sessión</div>
	  <div class="card-body">
	    
		<table>
			<tr>
				<th>Usuario</th>
			</tr>
			<tr>
				<td><input type="text" name="usuario" class="form-control"></td>
			</tr>
			<tr>
				<th>Contraseña</th>
			</tr>
			<tr>
				<td><input type="password" name="pass" class="form-control"></td>
			</tr>
			<br>
			<tr>
				<td><br><button class="btn btn-warning btn-lg btn-block">Ingresar</button></td>
			</tr>
		</table>
	  </div>
	</div>
</div>
