	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #F5ECCE;">
		  <div class="modal-header" style="background: #58FAAC;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="black"> Editar Sucursal</font></h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_sucursal" name="editar_sucursal">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre de la tienda" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			</div>
			<div class="form-group">
				<label for="mod_ruc" class="col-sm-3 control-label">Ruc</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_ruc" name="mod_ruc" placeholder="Ruc" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="mod_direccion" class="col-sm-3 control-label">Direccion</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_direccion" name="mod_direccion" placeholder="Direccion" required></textarea>
				</div>
			</div>
                        <div class="form-group">
				<label for="mod_correo" class="col-sm-3 control-label">Correo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_correo" name="mod_correo" placeholder="Correo" required></textarea>
				</div>
			</div>
                        <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">Telefono</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_telefono" name="mod_telefono" placeholder="Telefono" required></textarea>
				</div>
			 </div>
                        <div class="form-group">
				<label for="ubigeo" class="col-sm-3 control-label">Departamento</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="mod_departamento" name="mod_departamento" placeholder="Departamento" >
				  
				</div>
			  </div>
                         <div class="form-group">
				<label for="ubigeo" class="col-sm-3 control-label">Provincia</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="mod_provincia" name="mod_provincia" placeholder="Provincia" >
				  
				</div>
			  </div>
                         <div class="form-group">
				<label for="ubigeo" class="col-sm-3 control-label">Distrito</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="mod_distrito" name="mod_distrito" placeholder="Distrito" >
				  
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_ubigeo" class="col-sm-3 control-label">Ubigeo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_ubigeo" name="mod_ubigeo" placeholder="Ubigeo" required></textarea>
				</div>
			 </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>