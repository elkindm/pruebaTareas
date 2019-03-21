<div class="container">
	<br>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">Configuración de Usuarios</li>
	  </ol>
	</nav>
	<div class="card text-center">
	 
	  <ul class="nav nav-tabs" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" data-toggle="tab" href="#home">Usuarios</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-toggle="tab" href="#menu1">Perfiles</a>
		  </li>
		  
		</ul>
	  <div class="card-body">

	  	<div class="tab-content">

	      <div class="tab-pane container active" id="home">
	      	<div align="left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProducto"><b>+</b> Agregar Usuario</button></div>
	      	<br>
	      	<table class="table table-striped ">
	      		<thead class="thead-dark">
	      			<tr>
		      			<th>Usuario</th>
		      			<th>Nombres</th>
		      			<th>Estado</th>
		      			<th>Perfil</th>
		      		</tr>
	      		</thead>
	      		
	      	</table>
	      </div>
		  <div class="tab-pane container fade" id="menu1">Perfiles...
		  </div>
		  
		</div>
	  </div>
	</div>

	<div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="crearProducto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form id="guardaUsuario" method="post">
      	  <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<label>Usuario</label>
	      	<input type="text" name="usuario" id="usuario" class="form-control">
	      	<label>Contraseña</label>
	      	<input type="password" name="pass" id="pass" class="form-control">
	      	<label>Confirmar contraseña</label>
	      	<input type="password" name="cpass" id="cpass" class="form-control">
	      	<label>Identificación</label>
	      	<input type="number" name="identificacion" id="identificacion" class="form-control">
	      	<label>Primer Nombre</label>
	      	<input type="text" name="pnom" id="pnom" class="form-control">
	      	<label>Segundo Nombre</label>
	      	<input type="text" name="snom" id="snom" class="form-control">
	      	<label>Primer Apellido</label>
	      	<input type="text" name="pape" id="pape" class="form-control">
	      	<label>Segundo Apellido</label>
	      	<input type="text" name="sape" id="sape"  class="form-control">
	      	<label>Estado</label>
	      	<select name="estado" id="estado" class="form-control">
	      		<option value="">Seleccione...</option>
	      		<option value="A">Activo</option>
	      		<option value="I">Inactivo</option>
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