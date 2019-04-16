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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Datos para cierre de caja</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_caja" name="editar_caja">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_cat" class="col-sm-3 control-label">Cierre de Caja</label>
				<div class="col-sm-8">
				  <select class="form-control" id="cierre" name="cierre"  required>
                                      <option value="1">Cerrar Caja</option>   
                                  </select>   
					
				</div>
			  </div>
			   <input type="hidden" name="mod_id" id="mod_id">
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Inicio S/.</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="mod_inicio" name="mod_inicio" placeholder="Solo número de dos decimales" required readonly>
				  
				</div>
			  </div>
			  <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Entradas S/.</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="entrada" name="entrada" placeholder="Solo número de dos decimales" required readonly>
				  
				</div>
			  </div>
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Salidas S/.</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="salida" name="salida" placeholder="Solo número de dos decimales" required readonly>
				  
				</div>
			  </div>
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Cierre Optimo S/.</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="faltante" name="faltante" placeholder="Solo número de dos decimales" required readonly>
				  
				</div>
			  </div>
                           
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Cierre Real S/.</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="cierre1" name="cierre1" placeholder="Solo número de dos decimales" required>
				  
				</div>
			  </div>
			  
                        
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Cerrar caja</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>