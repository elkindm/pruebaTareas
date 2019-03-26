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
<script type="text/javascript">
	$(function(){
        $("#home").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("home"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo base_url().'Welcome/home';?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     		processData: false
            })
                .done(function(res){
                	console.log(res);
                	var res = JSON.parse(res);
                	 $('#usuario').val('');
		            $('#pass').val('');
		            
		            if (res['ruta']=="") {
		            	 mensage("Administrador de Sistema", res['text'], res['icon']);
		            	}else{ $(location).attr('href',res['ruta']);
		            }
                   
                });
                //location.reload();
        });
    });

    function entrar() {
    	window.location.replace("http://localhost/pruebaTareas/index.php/Welcome/tareas");
    	//window.location.href="/tareas";
    }

    function mensage(title,text,icon) {
		swal({
		  title: title,
		  text: text,
		  icon: icon,
		  buttons: true,
		  //dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    location.reload();
		  } 
		});
	}
</script>
	<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
	  <div class="card-header">Iniciar Sessión</div>
	  <div class="card-body">
	    <form id="home" method="post"  enctype="multipart/form-data">
		<table>
			<tr>
				<th>Usuario</th>
			</tr>
			<tr>
				<td><input type="number" name="usuario" class="form-control"></td>
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
		</form>
	  </div>
	</div>
</div>
