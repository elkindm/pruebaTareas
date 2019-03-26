<?php 
	$usuario=$session->userData('usuario');
	print_r($session->userData);
?>
<script type="text/javascript">
	window.onload=function(){
		$.ajax({
                data: {
                   dato:'' 	
                },
                type: "POST",
                url: "<?php echo base_url().'Tareas/buscar';?>",
                success: function(data) {
                	result = JSON.parse(data);
                	
                	$("#cuerpo").html(result['tabla']);
                	
                }
                            
             }); 
	}
	 $(function(){
        $("#guardaTarea").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("guardaTarea"));
            formData.append("usuario", "");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo base_url().'Tareas/crear';?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     		processData: false
            })
                .done(function(res){
                	var res = JSON.parse(res);
                	 $('#usuario').val('');
		            $('#pass').val('');
		            $('#cpass').val('');
		            $('#identificacion').val('');
		            $('#pnom').val('');
		            $('#snom').val('');
		            $('#pape').val('');
		            $('#sape').val('');
		            $('#estado').val('');
		            $('#permiso').val('');
		              
                    mensage("Administrador de Sistema", res, "success");
                });
                //location.reload();
        });
    });

	 $(function(){
        $("#actualizaTarea").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("actualizaTarea"));
            formData.append("usuario", "");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo base_url().'Tareas/actualizar';?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     		processData: false
            })
                .done(function(res){
                	var res = JSON.parse(res);
                	 $('#usuario').val('');
		            $('#pass').val('');
		            $('#cpass').val('');
		            $('#identificacion').val('');
		            $('#pnom').val('');
		            $('#snom').val('');
		            $('#pape').val('');
		            $('#sape').val('');
		            $('#estado').val('');
		            $('#permiso').val('');
		              
                    mensage("Administrador de Sistema", res, "success");
                });
                //location.reload();
        });
    });

	function buscard(){
		var dato="";
		var est=$("#est").val();
		var use="";
		var orde=$("#orde").val();
		if ($("#buscar").val()=="") {
			dato="false";
		}else{
			dato=$("#buscar").val();
		}
		if ($("#us").val()=="") {
			use="false";
		}else{
			var us=$("#us").val().split('-');
			use=us[0];
		}
		

		$.ajax({
                data: {
                   
                },
                type: "POST",
                url: "<?php echo base_url().'Tareas/buscar/';?>"+dato+"/"+est+"/"+use+"/"+orde,
                success: function(data) {
                	result = JSON.parse(data);
                	//resultbk=JSON.parse(data);
                	
                	//carga();
                	$("#cuerpo").html(result['tabla']);
                    //$("#valor").val(result['valor']);    
                                             		
                }
                            
             }); 
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

	
	 function editar(id) {
	 	$.ajax({
	        data: {
	            id:id 	
	        },
	        type: "POST",
	        url: "<?php echo base_url().'Tareas/editar';?>",
	        success: function(data) {
	            var data = JSON.parse(data);
	            $('#ids').val(data['id']);
	            $('#titulos').val(data['titulo']);
	            $('#descs').val(data['descripcion']);
	            $('#fechaVencimientos').val(data['fechaVencimiento']);
	            $('#finTareas').val(data['estado']);
	            /*$('#usuario').val(data['usuario']);
	            $('#pass').val(data['clave']);
	            $('#cpass').val(data['confirma']);
	            $('#identificacion').val(data['numeroIdentificacion']);
	            $('#pnom').val(data['primerNombre']);
	            $('#snom').val(data['segundoNombre']);
	            $('#pape').val(data['primerApellido']);
	            $('#sape').val(data['segundoApellido']);
	            $('#estado').val(data['estado']);
	            $('#permiso').val(data['perfil']);*/
	            $('#editarTarea').modal({
			        show: true
			    });    
	        }
        }); 
	 }
	 function elimina(id) {
		swal({
		  title: "¿Está seguro de eliminar la Tarea?",
		  text: '',
		  icon: 'warning',
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
		        url: "<?php echo base_url().'Tareas/borrar ';?>",
		        success: function(data) {
		            var data = JSON.parse(data);
		           mensage('Administrador',data,'success');
		        }
	        }); 
		  } 
		});
	}
</script> 
<div class="container">
	<br>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">Gestión de Tareas</li>
	  </ol>
	</nav>
	<div class="card text-center">
	 
	
	  <div class="card-body">
	  		<div class="row">
	  			<div class="col">
	  				<input type="shearch" name="buscar" id="buscar" class="form-control" placeholder="Buscar por Nombres y Apellido" onkeyup="buscard()">
	  			</div>
	  			<div class="col">
	  				<select name="est" id="est" onchange="buscard()" class="form-control">
	  					<option value="false">¿tarea finalizada?</option>
	  					<option value="SI">SI</option>
	  					<option value="NO">NO</option>
	  				</select>
	  			</div>
	  			<div class="col">
	  				<input list="browsers" name="us" id="us" class="form-control" onchange="buscard()" placeholder="usuarios">

						<datalist id="browsers">

						  <?php foreach ($usuarios as $keys): ?>
						  	<option value="<?php echo($keys->usuario.'-'. $keys->primerNombre.' '.$keys->primerApellido) ?>">
						  <?php endforeach ?>
						  
						</datalist>
	  			</div>
	  			<div class="col">
	  				<select name="orde" id="orde" onchange="buscard()" class="form-control">
	  					<option value="false">ordenar por Fecha de Vencimiento</option>
	  					<option value="ASC">Ascendete</option>
	  					<option value="DESC">Descendete</option>
	  				</select>
	  			</div>
			      		
			</div>
	  	<div class="tab-content">
	  		<br>
	      <div class="tab-pane container active" id="home">
	      	<div align="left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProducto"><b>+</b> Nueva Tarea</button></div>
	      	<br>
	      	<div id="cuerpo"></div>
	      	
	      </div>
		  <div class="tab-pane container fade" id="menu1">Perfiles...
		  </div>
		  
		</div>
	  </div>
	</div>

	<div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="crearProducto" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form id="guardaTarea" method="post"  enctype="multipart/form-data">
	      	  <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Formulario de Tareas</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<label></label>
		      	<input type="number" name="id" id="id" class="form-control" style="display: block;">
		      	<label>Titulo de la Tarea</label>
		      	<input type="text" name="titulo" id="titulo" class="form-control" required="true" >
		      	<label>Descripción de la tarea</label>
		      	<textarea name="desc" id="desc" class="form-control" required="true" ></textarea>
		      	<label>Fecha de Vencimiento de la tarea</label>
		      	<input type="date" name="fechaVencimiento" id="fechaVencimiento" class="form-control" required="true">
		      	<label>Finaizó tarea:</label>
		      	<select name="finTarea" id="finTarea" class="form-control" required="true">
		      		<option value="">Seleccione...</option>
		      		<option value="SI">SI</option>
		      		<option value="NO">NO</option>
		      	</select>
		      	
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class='btn btn-danger'>Guardar</button>
		      </div>
		  </form>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="editarTarea" tabindex="-1" role="dialog" aria-labelledby="editarTarea" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<form id="actualizaTarea" method="post"  enctype="multipart/form-data">
	      	  <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Actualización de Tareas</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<label></label>
		      	<input type="number" name="ids" id="ids" class="form-control" style="display: block;">
		      	<label>Titulo de la Tarea</label>
		      	<input type="text" name="titulos" id="titulos" class="form-control" required="true" >
		      	<label>Descripción de la tarea</label>
		      	<textarea name="descs" id="descs" class="form-control" required="true" ></textarea>
		      	<label>Fecha de Vencimiento de la tarea</label>
		      	<input type="date" name="fechaVencimientos" id="fechaVencimientos" class="form-control" required="true">
		      	<label>Finaizó tarea:</label>
		      	<select name="finTareas" id="finTareas" class="form-control" required="true">
		      		<option value="">Seleccione...</option>
		      		<option value="SI">SI</option>
		      		<option value="NO">NO</option>
		      	</select>
		      	
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class='btn btn-danger'>Guardar</button>
		      </div>
		  </form>
	    </div>
	  </div>
	</div>
</div>