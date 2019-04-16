	<!DOCTYPE html>
<head>
  <script> 
function multiplicar(){
m1 = document.getElementById("multiplicando").value;
m2 = document.getElementById("costo").value;
m3 = document.getElementById("uti").value;
r = m1*m2;
document.getElementById("resultado").value = r;

r2=document.getElementById("resultado").value;
r1=1*r2+1*m3;
document.getElementById("precio").value = r1;
}
</script> 
<script type="text/javascript">
	function va(esto)
	{		
		document.getElementById('multiplicando').value=esto;
                m2 = document.getElementById("costo").value;
                m3 = document.getElementById("uti").value;
                r = esto*m2;
                document.getElementById("resultado").value = r;
                r2=document.getElementById("resultado").value;
                r1=1*r2+1*m3;
                document.getElementById("precio").value = r1;
	}
	</script>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
  }
</script>
</head>
<?php
$nom = array();
$sql2="select * from products ";
$i=0;
$rs1=mysqli_query($con,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    $nom[$i]=$row3["nombre_producto"];
    $i=$i+1;
}
?>
    <body>  
        <div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background: #F5ECCE;">
		  <div class="modal-header" style="background: #58FAAC;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> <font color="black">Agregar nuevo producto en la Tienda<?php echo $_SESSION['tienda']; ?></font></h4>
		  </div>
                    <div id="resultados_ajax_productos"></div>
		  <div class="modal-body" style="height:500px;overflow-y: scroll;">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">
                                    
				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
				  
				</div>
			</div>
                        <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Categoria</label>
				<div class="col-sm-8">
				 <select class="form-control" id="cat_pro" name="cat_pro" required>
					<option value="">-- Selecciona Categoria --</option>
			
                        <?php
                        $nom = array();
                        $sql2="select * from categorias ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option value="<?php  echo $id_categoria;?>"><?php  echo $nom_cat;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                         </select>
				</div>
                        </div>
                         <div class="form-group">
				<label for="und_pro" class="col-sm-3 control-label">Und/Medida</label>
				<div class="col-sm-8">
				 <select class="form-control" id="und_pro" name="und_pro" required>
					<option value="">-- Selecciona und/medida de producto --</option>
			
                        <?php
                                        
                                        $sql3="select * from und ";
                                        $rs3=mysqli_query($con,$sql3);
                                        while($row4=mysqli_fetch_array($rs3)){
                                            $nom_und=$row4["nom_und"];
                                            $id_und=$row4["id_und"];
                                        ?>

                                        <option value="<?php echo $id_und;?>"><?php  echo $nom_und;?></option>

                                        <?php
                                        }         
                                        ?>    
                         </select>
				</div>
                        </div>    
                        <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo de Producto</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona tipo --</option>
					<option value="1">Nuevo</option>
					<option value="0">De segunda</option>
                                        <option value="2">Repuesto</option>
				  </select>
				</div>
			</div>
                        <div class="form-group">
				<label for="marca" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="marca" name="marca" placeholder="marca" >
				</div>
			</div>
                        <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="modelo" name="modelo" placeholder="modelo" >
				</div>
			</div>
                        <div class="form-group">
				<label for="color" class="col-sm-3 control-label">Color</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="color" name="color" placeholder="color" >
				</div>
			</div>
			<div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Costo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" onChange="multiplicar();" id="costo" name="costo" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			</div>
                       
                     
                        <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
                                    <input type="text"  class="form-control" id="precio" name="precio" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
                       
                         <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Inventario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precio" name="inventario" placeholder="Inventario inicial del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
                      <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  
                  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
	//	}
	?>
</body>
            
</html>