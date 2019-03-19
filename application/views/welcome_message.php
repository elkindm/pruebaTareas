<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Empresa Grupo bien pensado</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <script src="http://localhost/Gpbp/bootstrap/js/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="http://localhost/Gpbp/bootstrap/css/bootstrap.css">
	
	<script src="http://localhost/Gpbp/bootstrap/js/bootstrap.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
</head>
<body>
<div class="jumbotron">
  <h1>Empresa</h1> 
  
</div>
<div class ="container">
	<script type="text/javascript">
		window.onload=function() {
			$.ajax({
                data: {
                    	
                },
                type: "POST",
                url: "<?php echo base_url().'buscar';?>",
                success: function(data) {
                	var result = JSON.parse(data);
                	$("#productos").html(result['tabla']);
                    //$("#valor").val(result['valor']);    
                                             		
                }
                            
             }); 
		}
		function cambiarEstado(id) {
			swal({
				  title: "¿Esta  Seguro de querer cambiar el estado?",
				  text: "",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
			.then((willDelete) => {
  				if (willDelete) {
    				$.ajax({
	                data: {
	                   id:id 	
	                },
	                type: "POST",
	                url: "<?php echo base_url().'cambiarEstado';?>",
	                success: function(data) {
	                	var result = JSON.parse(data);
	                	//$("#productos").html(result['tabla']);
	                    //$("#valor").val(result['valor']);    
	                                             		
	                }
                            
             		}); 
  				} else {
   				 
  				}
			});
		}

		function buscarn(argument) {
			$.ajax({
                data: {
                    producto:$("#producto").val()	
                },
                type: "POST",
                url: "<?php echo base_url().'buscarn';?>",
                success: function(data) {
                	var result = JSON.parse(data);
                	$("#productos").html(result['tabla']);
                    //$("#valor").val(result['valor']);    
                                             		
                }
                            
             });
		}
	</script>

	<div class="card" >
	  <div class="card-body">
	    <h5 class="card-title">Productos</h5>
	   	<div class="row">
			  <div class="col-sm-4">
			  	<input type="text" name="producto" id="producto" placeholder="Buscar" class="form-control" onblur="buscarn()">
			  </div>
			  <div class="col-sm-8" align="center">
			  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProducto">Crear Producto</button>
			  </div>
		</div>

		<div id='productos'></div>	
	    
	  </div>
	</div>
	

<!-- Modal -->
<div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="crearProducto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<form action="<?php echo base_url().'guradaProducto';?>" method="post">
	        <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <label>Producto</label>
	        <input type="text" name="nombre" class="form-control">
	        <div class="row">
	        	
	        	<div class="col">
	        		<label>Cantidad</label>
	        		<input type="number" name="cantidad" class="form-control"></div>
	        	<div class="col">
	        		<label>Estado</label>
	        		<select name="estado" class="form-control">
	        			<option value="">Selecione...</option>
	        			<?php foreach ($estado as $key ): ?>
	        				<option value="<?=$key->codigo ?>"><?=$key->detalle ?></option>
	        			<?php endforeach ?>
	        		</select>
	        	</div>
	        </div>
	        <label>Bodega</label>
	        <select name="bodega" class="form-control">
	        			<option value="">Selecione...</option>
	        			<?php foreach ($bodega as $key ): ?>
	        				<option value="<?=$key->codigo ?>"><?=$key->detalle ?></option>
	        			<?php endforeach ?>
	        		</select>
	      </div>
	      <label>Observaciones</label>
	      <textarea  name="observaciones" class="form-control"></textarea>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-danger">Guardar</button>
	      </div>
	  </form>
    </div>
  </div>
</div>

</div>



</div>


		
	
		
</div>

</body>
</html>