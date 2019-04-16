<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos 
$mensaje=recoge1('mensaje');

$consulta1 = "SELECT * FROM products ";
$result1 = mysqli_query($con, $consulta1);
$producto = array();
$i=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if ($valor1['pro_ser']==1){
    $producto[$i]=$valor1['nombre_producto'];
    $i=$i+1;
    }
}
$consulta2 = "SELECT * FROM datosempresa ";
$result2 = mysqli_query($con, $consulta2);
$valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$dolar=$valor2['dolar'];
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[10]==0){
    header("location:error.php");    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> 
  
  Ingreso de productos
  </title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
 <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
    
  }
</script>
<style type="text/css"> 
    .fijo {
	background: #333;
	color: white;
	height: 10px;
	
	width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
	left: 0; /* Posicionamos la cabecera al lado izquierdo */
	top: 0; /* Posicionamos la cabecera pegada arriba */
	position: fixed; /* Hacemos que la cabecera tenga una posición fija */
} 




    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 .valor1 {
              

border-bottom: 2px solid #F5ECCE;

}  

-valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 


</style>


</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

         
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <?php
          menu2();
         
          menu1();
          
          ?>
       
        </div>
      </div>

        
        <?php
          menu3();
     
        
        ?>

      <div class="right_col" role="main">

          <div style="background:<?php echo COLOR;?>"> 
          
          <div class="panel panel-info">
		<div class="panel-heading">
		   
                    <h3>Ingresar datos del producto:</h3>
		</div>        
        </div>  
           <?php
          
          if($mensaje<>"")
              {
              ?>
               <div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error! <?php echo $mensaje;?></strong> 
					
			</div>
             <?php 
          }
       
     
            print"<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\" enctype=\"multipart/form-data\" action=\"ingresoproductos1.php\" method=\"POST\">";

            ?>
       
                        <div class="form-group">
				<label for="codigo"  class="col-sm-3 control-label">Código del producto <font color="Red"><strong>(Sin repetir):</strong></font>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    
				  <input type="text"  class="textfield10" autocomplete="off" class="form-control" id="codigo" name="codigo" placeholder="El código debe ser corto" required>
				</div>
			  </div>
          
                        <div class="form-group">
                            <label for="nombre"  class="col-sm-3 control-label">Nombre del producto <font color="Red"><strong>(Sin repetir):</strong></font></label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input class="textfield10" autocomplete="off" type="text" class="form-control" id="autocomplete-custom-append" name="nombre" placeholder="Nombre del producto" required>
				  <div  id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 3px;">
				</div>
			  </div>
                        </div>
                        <div class="form-group">
                                
                            
				<label for="nombre" class="col-sm-3 control-label">Ingresar foto:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input class="textfield10" id="valor1" accept="image/jpeg" type="file" id="files" name="files" class="form-control"/>
				  
				</div>
			  </div>   
                        <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Categoria</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				 <select  class="textfield10" class="form-control" id="cat_pro" name="cat_pro" required>
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
			  
                            
                         
				<label for="cat_pro" class="col-sm-2 control-label">Und/Medida</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				 <select  class="textfield10" class="form-control" id="und_pro" name="und_pro" required>
						
                        <?php 
                       
                        $sql3="select * from und ";
                       
                        $rs3=mysqli_query($con,$sql3);
                        while($row3=mysqli_fetch_array($rs3)){
                            $nom_und=$row3["nom_und"];
                            $id_und=$row3["id_und"];
                            ?>
                            <option value="<?php  echo $id_und;?>"><?php  echo $nom_und;?></option>

                            <?php

                            
                        }
                        
                        ?>
                     
                         </select>
				</div>
			 
                            
                            </div>    
                                
                                
                          
                                
                                
                         <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo de Producto</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				 <select   class="textfield10" class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona tipo --</option>
					<option value="1">Nuevo</option>
					<option value="0">De segunda</option>
                                        <option value="2">Repuesto</option>
				  </select>
				</div>
			  
				<label for="marca" class="col-sm-2 control-label">Marca</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				  <input class="textfield10" type="text"  class="form-control" id="marca" name="marca" placeholder="marca" required>
				</div>
			  </div>
                        
                        
                         <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input class="textfield10" type="text"  class="form-control" id="modelo" name="modelo" placeholder="modelo" required>
				</div>
			  
				<label for="color" class="col-sm-2 control-label">Color</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				  <input class="textfield10" type="text" autocomplete="off" class="form-control" id="color" name="color" placeholder="color" required>
				</div>
			  </div>
                      
			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Costo</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="textfield10" type="text" autocomplete="off" class="form-control" onChange="multiplicar();" id="costo" name="costo" placeholder="Costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  
                         <input type="hidden" name="multiplicando"   value="1" >
                      
                        
				<label for="precio" class="col-sm-1 control-label">Precio</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="textfield10" type="text"  autocomplete="off" class="form-control" id="precio" name="precio"  placeholder="Precio">
				</div>
			  
                         <!--
                         <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">%ISC al valor</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text"  autocomplete="off" class="form-control" id="por_isc" name="por_isc"  value="0" placeholder="Porcentaje ISC">
				</div>
                                <div class="col-md-1 col-sm-1 col-xs-12">%
                                </div>    
			  </div>
                         -->
                         
				  <input type="hidden"  class="form-control" id="precio1" name="precio1"  value="0">
				     
                                
			 
				  <input type="hidden"  class="form-control" id="precio2" name="precio2"  value="0">
				
                      
                         
				<label for="precio" class="col-sm-2 control-label">Inventario (Stock)</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="textfield10" type="text" autocomplete="off" class="form-control" id="precio" name="inventario" placeholder="Inventario inicial del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
       
    <?php
    $nom = array();
    $sql2="select * from products ";
    $i=0;
$rs1=mysqli_query($con,$sql2);
while($row3=mysqli_fetch_array($rs1)){
  
    $nom[$i]=$row3["nombre_producto"];
    $i=$i+1;
}
  
$sql3="select distinct marca from products ";
    $i=0;
$rs2=mysqli_query($con,$sql3);
while($row4=mysqli_fetch_array($rs2)){
   
    $marca[$i]=$row4["marca"];

    $i=$i+1;
}

$sql4="select distinct modelo from products ";
    $i=0;
$rs4=mysqli_query($con,$sql4);
while($row5=mysqli_fetch_array($rs4)){
    $modelo[$i]=$row5["modelo"];
    $i=$i+1;
}

$sql5="select distinct color from products ";
$i=0;
$rs5=mysqli_query($con,$sql5);
while($row6=mysqli_fetch_array($rs5)){
    $color[$i]=$row6["color"];
    $i=$i+1;
}
    ?>       
    <script>
      
var tags = [];
                <?php
                    for($i = 0 ;$i<count($nom);$i++){
                ?>
                tags.push("<?php echo $nom[$i];?>");
                <?php } ?>
                         
    $( "#producto" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags, function( item ){
              return matcher.test( item );
          }) );
      }
});


</script>    
        
 
 </td></tr>
     
     

    <script>
    var tags1 = [];
                <?php
                    for($i = 0 ;$i<count($marca);$i++){
                ?>
                tags1.push("<?php echo $marca[$i];?>");
                <?php } ?>
                
  

            
    $("#marca" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags1, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    
    <script>
    var tags2 = [];
                <?php
                    for($i = 0 ;$i<count($modelo);$i++){
                ?>
                tags2.push("<?php echo $modelo[$i];?>");
                <?php } ?>
                
  

            
    $("#modelo" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags2, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
   
    
     <script>
    var tags3 = [];
                <?php
                    for($i = 0 ;$i<count($color);$i++){
                ?>
                tags3.push("<?php echo $color[$i];?>");
                <?php } ?>
                
  

            
    $("#color" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags3, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
      
           <div class="modal-footer">
                      <button type="button" class="btn btn-success" onclick="limpiarFormulario()">Limpiar</button>
			
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  
                  </div>
		  </form>
          
          
          
           </div>
          </div>
         
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  
  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });

    var asInitVals = new Array();
    $(document).ready(function() {
      var oTable = $('#example').dataTable({
        "oLanguage": {
          "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
          } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/datatables/tools/swf/copy_csv_xls_pdf.swf"
        }
      });
      $("tfoot input").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
      });
      $("tfoot input").each(function(i) {
        asInitVals[i] = this.value;
      });
      $("tfoot input").focus(function() {
        if (this.className == "search_init") {
          this.className = "";
          this.value = "";
        }
      });
      $("tfoot input").blur(function(i) {
        if (this.value == "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
        }
      });
    });
  </script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      
      var data =[
      <?php
                    for($i = 0;$i<count($producto);$i++){
                ?>
                '<?php echo $producto[$i];?>',
                <?php } ?>];
     
      
      
      var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->
  
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Seleccionar",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "Con Max Selección límite de 4",
        allowClear: true
      });
    });
  </script>
  
  
  
</body>

</html>

