<script type="text/javascript">
	var result;
	var resultbk;
	 window.onload=function(){
		$.ajax({
                data: {
                   dato:'' 	
                },
                type: "POST",
                url: "<?php echo base_url().'Usuarios/buscar';?>",
                success: function(data) {
                	result = JSON.parse(data);
                	//resultbk=JSON.parse(data);
                	
                	//carga();
                	$("#cuerpo").html(result['tabla']);
                    //$("#valor").val(result['valor']);    
                                             		
                }
                            
             }); 
	}
	function carga(){
		let cuerpo= document.getElementById("cuerpo");

		while(cuerpo.rows.length > 0){
			cuerpo.deleteRow(0);
		}
                	var estado='';
                	var perfils='';
                	result.forEach(dt=>{
                		let fila=cuerpo.insertRow(cuerpo.rows.length);
                		if (dt.estado='A') {
                			estado='Activo';
                		}else{
                			estado='Inactivo';
                		}
                		switch (dt.perfil){
                			case '1':
		      					perfils="Sistemas";
		      					break;
		      				case '2':
		      					perfils="Administrador";
		      					break;
		      				case '3':
		      					perfils="Operador";
		      					break;
		      				case '4':
		      					perfils="Auditor";
		      					break;
		      					
                		}
                		fila.insertCell(0).innerHTML=dt.usuario;
                		fila.insertCell(1).innerHTML=dt.primerNombre+' '+dt.primerApellido;
                		fila.insertCell(2).innerHTML=estado;
                		fila.insertCell(3).innerHTML=perfils;
                		fila.insertCell(4).innerHTML="<button type='button' class='btn btn-danger' onclick='elimina("+dt.usuario+")'>Eliminar</button>";
                	})
	}
	function buscard(){
		var dato=$("#buscar").val();
		$.ajax({
                data: {
                    dato:dato	
                },
                type: "POST",
                url: "<?php echo base_url().'Usuarios/buscar';?>",
                success: function(data) {
                	result = JSON.parse(data);
                	//resultbk=JSON.parse(data);
                	
                	//carga();
                	$("#cuerpo").html(result['tabla']);
                    //$("#valor").val(result['valor']);    
                                             		
                }
                            
             }); 
		/*result=resultbk;
		result=result.filter(dts=>{
			//return dts.primerNombre.toLowerCase().indexOf(dato) > -1;
			return dts.primerNombre.toLowerCase().indexOf(dato) || dts.perfil.toLowerCase().indexOf(dato) > -1;
		});
		carga();
		console.log(result);*/
	}
	function validaPass() {
		
		if ($("#pass").val()!=$("#cpass").val()) {
			swal("Administrador de Sistema", "La contraseña no coinside!", "error");
			$("#pass").val("");
			$("#cpass").val("");
		}
	}
	 $(function(){
        $("#guardaUsuario").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("guardaUsuario"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo base_url().'Usuarios/guardaUsuario';?>",
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

	function elimina(id) {
		swal({
		  title: "¿Está seguro de eliminar el usuario?",
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
		        url: "<?php echo base_url().'Usuarios/elimina';?>",
		        success: function(data) {
		            var data = JSON.parse(data);
		           mensage('Administrador',data,'success');
		        }
	        }); 
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
	        url: "<?php echo base_url().'Usuarios/editar';?>",
	        success: function(data) {
	            var data = JSON.parse(data);
	            $('#usuario').val(data['usuario']);
	            $('#pass').val(data['clave']);
	            $('#cpass').val(data['confirma']);
	            $('#identificacion').val(data['numeroIdentificacion']);
	            $('#pnom').val(data['primerNombre']);
	            $('#snom').val(data['segundoNombre']);
	            $('#pape').val(data['primerApellido']);
	            $('#sape').val(data['segundoApellido']);
	            $('#estado').val(data['estado']);
	            $('#permiso').val(data['perfil']);
	            $('#crearProducto').modal({
			        show: true
			    });    
	        }
        }); 
	 }
</script> 
<div class="container">
	<br>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">Configuración de Usuarios</li>
	  </ol>
	</nav>
	<div class="card text-center">
	 
	
	  <div class="card-body">
	  	<?php if ($error==""){ ?>
		  	<div class="tab-content">

		      <div class="tab-pane container active" id="home">
		      	
		      	<form>
		      		<div align="left">
			      		<input type="shearch" name="buscar" id="buscar" class="form-control" placeholder="Buscar por Nombres y Apellido" onkeyup="buscard()">
			      	</div>
			      	<br>
			      	<div id="cuerpo"></div>
			      	<!--<table class="table table-striped ">
			      		<thead class="thead-dark">
			      			<tr>
				      			<th>Usuario</th>
				      			<th>Nombres</th>
				      			<th>Estado</th>
				      			<th>Perfil</th>
				      			<th>
				      				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProducto"><b>+</b> Agregar Usuario</button>
				      			</th>
				      		</tr>
			      		</thead>
			      		<tbody >
			      			<div id="cuerpo" ></div>
			      			<?php /*foreach ($usuarios as $key ):
			      				/*$estado="";
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
			      			 ?>
			      				<tr ondblclick="editar(<?php echo $key->usuario; ?>)" title="Doble clic para editar" style="cursor: pointer;">
			      					<td><?php echo $key->usuario; ?></td>
			      					<td><?php echo $key->primerNombre." ".$key->primerApellido; ?></td>
			      					<td><?php echo $estado; ?></td>
			      					<td><?php echo $perfils; ?></td>
			      					<td><button class="btn btn-danger" onclick="elimina(<?php echo $key->usuario; ?>)">Eliminar</button></td>
			      					
			      				</tr>
			      			<?php endforeach*/ ?>
			      		</tbody>
			      		
			      	</table>-->
		      	</form>
		      </div>
			  <div class="tab-pane container fade" id="menu1">Perfiles...
			  </div>
			  
			</div>
		<?php }else{
			echo "<div class='alert alert-warning' role='alert'>
 					 $error
				</div>"	;
		} ?>
	  </div>
	</div>

	<div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="crearProducto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form id="guardaUsuario" method="post"  enctype="multipart/form-data">
      	  <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Formulario de  Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<label>Usuario</label>
	      	<input type="number" name="usuario" id="usuario" class="form-control"  value="<?=$musuario->max+1 ?>">
	      	<label>Contraseña</label>
	      	<input type="password" name="pass" id="pass" class="form-control" required="true">
	      	<label>Confirmar contraseña</label>
	      	<input type="password" name="cpass" id="cpass" class="form-control" required="true" onblur="validaPass()">
	      	<label>Identificación</label>
	      	<input type="number" name="identificacion" id="identificacion" class="form-control" required="true">
	      	<label>Primer Nombre</label>
	      	<input type="text" name="pnom" id="pnom" class="form-control" required="true">
	      	<label>Segundo Nombre</label>
	      	<input type="text" name="snom" id="snom" class="form-control" >
	      	<label>Primer Apellido</label>
	      	<input type="text" name="pape" id="pape" class="form-control" required="true">
	      	<label>Segundo Apellido</label>
	      	<input type="text" name="sape" id="sape"  class="form-control" >
	      	<label>Estado</label>
	      	<select name="estado" id="estado" class="form-control" required="true">
	      		<option value="">Seleccione...</option>
	      		<option value="Activo">Activo</option>
	      		<option value="Inactivo">Inactivo</option>
	      	</select>
	      	<label>Permisos</label>
	      

	      	<select name="permiso" id="permiso" class="form-control" required="true">
	      		<option value="">Seleccione...</option>
	      		<?php foreach ($perfil as $key ): ?>
	      			<option value="<?= $key->detalle ?>"><?= $key->detalle ?></option>
	      		<?php endforeach ?>
	      		
	      	</select>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-danger">Guardar</button>
	      </div>
	  </form>
    </div>
  </div>
</div>
</div>