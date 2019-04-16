<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$consulta1 = "SELECT * FROM users ";
$result1 = mysqli_query($con, $consulta1);
$usuario = array();
$i=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {   
    $usuario[$i]=$valor1['nombres'];
    $i=$i+1;  
}
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$sql2="select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$tienda1=$rs2["tienda"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[32]==0){
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
  Venta Servicios Tecnicos
  
  </title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="css/icheck/flat/green.css" rel="stylesheet">
<link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {     
border-bottom: 2px solid #F5ECCE;
}  
#valor1:hover {             
background-color: white;
border-bottom: 2px solid #A9E2F3;
} 
.dt-button.red {
        color: black;
        
        background:red;
    }
 
    .dt-button.orange {
        color: black;
        background:orange;
    }
 
    .dt-button.green {
        color: black;
        background:green;
    }
    
    .dt-button.green1 {
        color: black;
        background:#01DFA5;
    }
    
    .dt-button.green2 {
        color: black;
        background:#2E9AFE;
    }
</style>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
            <div class="clearfix"></div>
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
<?php 
$consulta2 = "SELECT * FROM consultas ";
$result2 = mysqli_query($con, $consulta2);
$d="";
$cliente="";
$fecha1="";
$fecha2="";
$tienda=0;
$tipo4=0;
$dd1="";
$dd2="";
$tipo3=0;
$tipo2=0;
while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    if ($valor1['tipo']==21){
        $d=$valor1['a1'];
        $cliente=$valor1['a1'];
        $fecha1=$valor1['a2'];
        
        $fecha2=$valor1['a3'];
        $tiend=$valor1['a4'];
        $tipo=$valor1['a5'];
        $tipo4=$valor1['a6'];
        if($tipo==5){
            $tipo3=1;                    
            $tipo2=5;
        }else{
            $tipo3=$tipo;                    
            $tipo2=$tipo;
        }
        if($tiend==7){
            $tienda1=1;
            $tienda2=$tienda1;
        }else{
            $tienda1=$tiend;
            $tienda2=$tiend;
        }
          
        if ($fecha1<>""){
            $d1 = explode("-", $fecha1);
            $dia1=$d1[0]; 
            $mes1=$d1[1];
            $ano1=$d1[2];
        }
            $dd1=$ano1."-".$mes1."-".$dia1;
        if ($fecha2<>""){
            $d2 = explode("-", $fecha2);
            $dia2=$d2[0]; 
            $mes2=$d2[1];
            $ano2=$d2[2];
            $dd2=$ano2."-".$mes2."-".$dia2;
        }
 
    }
}
?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background:#81F79F;">
                <div class="panel panel-info">
                    <div class="panel-heading">
		   
                        Buscar Venta de Servicios por Tecnicos:
                    </div>        
                </div>         
                <form  name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="ventaserviciostecnicos1.php">
                     <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                          <label>Nombre del Tecnico:</label>
                        <input placeholder="Nombre del Tecnico" type="text" value="<?php echo $cliente;?>" name="cliente" id="autocomplete-custom-append" data-validate-length-range="4" class="form-control col-md-10" style="float: left;" />
                        <div  id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 3px;">
                      </div>
                        </div>
                     
                          <div class="col-md-2 col-sm-3 col-xs-12">
                            <label>Fecha Inicial:</label>
                            <input   name="fecha1"  data-validate-length-range="4" type="date"  class="form-control col-md-10" style="float: left;" id="fecha1"   value="<?php echo $fecha1;?>" required>
                          </div>
                      
                       <div class="col-md-2 col-sm-3 col-xs-12">
                            <label>Fecha Final:</label>
                            <input   name="fecha2"  data-validate-length-range="4" type="date"  class="form-control col-md-10" style="float: left;" id="fecha2"   value="<?php echo $fecha2;?>" required>
                        </div>
                     
                      <div class="col-md-2 col-sm-3 col-xs-12">
                        <label>Tipo de Equipo:</label>
                           <select class="form-control col-md-10" name="tipo" required="required" tabindex="-1">
                            <?php
                            if($tipo>0){
                                
                                if($tipo==5){
                                    $t1="Todos";
                                }
                                if($tipo==1){
                                    $t1="Laptops";
                                }
                                
                                if($tipo==2){
                                    $t1="Computadoras";
                                }
                                
                                if($tipo==3){
                                    $t1="Impresoras";
                                }
                                
                                if($tipo==4){
                                    $t1="Monitores";
                                }
                                ?>
                               <option value="<?php echo $tipo; ?>" ><?php echo $t1; ?></option>
                            <?php
                               }else{
                                  ?>
                               <option value="0" >Escoger</option>
                            <?php  
                               }
                             
                            ?>
                            
                            <option value="1" >Laptops</option>
                            <option value="2" >Computadoras</option>
                            <option value="3" >Impresoras</option>
                            <option value="4" >Monitores</option> 
                            <option value="5" >Todos</option>
                            </select>
                            <br>
                        <br>
                        </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Reparación:</label>
                           <select class="form-control col-md-10" name="tipo1" required="required" tabindex="-1">
                            <?php
                            
                                
                                if($tipo4==1){
                                    $t2="Reparado";
                                }
                                if($tipo4==0){
                                    $t2="No reparado";
                                }
                                if($tipo4==2){
                                    $t2="Todos";
                                }
                                
                                ?>
                               <option value="<?php echo $tipo4; ?>" ><?php echo $t2; ?></option>
                           
                            <option value="0" >No reparado</option>
                            <option value="1" >Reparado</option>
                           
                        </select>
                        <br>
                      <br>
                      </div>       
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Sucursal:</label>
                           <select class="form-control col-md-10" name="tienda" required="required" tabindex="-1">
                            <?php
                            if($tiend>0){
                                
                                if($tiend==4){
                                    $t="Todas";
                                }else{
                                    $t="Sucursal $tiend";
                                }
                                
                                ?>
                               <option value="<?php echo $tiend; ?>" ><?php echo $t; ?></option>
                            <?php
                               }else{
                                  ?>
                               <option value="0" >Escoger</option>
                                <?php  
                               }
                                for($i=1 ;$i<=$tienda1;$i++){
                                ?>
                                <option value="<?php echo $i;?>" >Sucursal <?php echo $i;?></option>              
                               <?php
        
                                } 
                                ?>
                            
                           
                            <option value="7" >Todas</option>                                                              
                        </select>
                        <br>
                      <br>
                      </div>   
                      
                      <input type="hidden" name="d" value="1">
                        <button id="send" type="submit" name="enviar" class="btn btn-success">Buscar</button>
                  
                    </form>
                  
          
                   </div>
                   </div>
               </div>
       <div class="row">
     <?php
                       
$total1=0;
if($d==""){
    $sql="select * from servicio, clientes, users where servicio.id_cliente=clientes.id_cliente and servicio.user_id=users.user_id"; 
}else{
     $sql="select * from servicio, clientes, users where servicio.id_cliente=clientes.id_cliente and servicio.user_id=users.user_id"; 
}
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$aa="http://".$host.$url;
?>          
  <div class="table-responsive">
                   
                  <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                      <tr style="background-color:#FE9A2E;color:white; ">
                       <th>Numero Doc </th>
                        
                       <?php
                       if($tipo4==1){
                           $fec="Fecha Reparacion";
                       }
                       if($tipo4==0){
                           $fec="Fecha Despacho";
                       }
                       ?>
                       
                        <th>Tipo </th>
                        <th>Cliente </th>
                        <th style="background-color:red;color:white; ">Fecha Despacho </th>
                        <th style="background-color:red;color:white; ">Tecnico Despacha</th>
                        <th>Total  </th>
                        <th style="background-color:#0101DF;color:white; ">Reparado  </th>
                        <th style="background-color:#0101DF;color:white; ">Tecnico Repara  </th>
                        <th style="background-color:#0101DF;color:white; ">Fecha Repara </th>
                        <th style="background-color:#FE2E64;color:white; ">Equipo  </th>
                       
                        <th style="background-color:#FE2E64;color:white; ">Tecnico entrega  </th>
                       
                        <th style="background-color:#FE2E64;color:white; ">Fecha Entrega </th>
                      </tr>
                    </thead>

                    <tbody>  
 <?php   
    

$s=1;
$rs=mysqli_query($con,$sql);
while($row= mysqli_fetch_array($rs)){

$numero_factura=$row['doc_servicio'];
$ter_ser=$row['reparado'];
$id_reparado=$row['id_reparado'];
$id_entregado=$row['id_entregado'];
$id_entregado1=""; 
$id_reparado1="";   
$sql2="select * from $db_users ";    
$rs1=mysqli_query($db,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    
    if($id_entregado==$row3["user_id"]){
       $id_entregado1=$row3["nombres"]; 
    }
    if($id_reparado==$row3["user_id"]){
       $id_reparado1=$row3["nombres"]; 
       $vendedor2=$row3["nombres"]; 
    }

}
$fecha4=$row['fecha_reparado'];
$d4 = explode("-",$fecha4);
$dia1=date("d",strtotime($fecha4)); 
$mes1=$d4[1];  
$ano1=$d4[0];
$d1=$ano1."-".$mes1."-".$dia1;
$dd5=$dia1."-".$mes1."-".$ano1." (".date("H:i",strtotime($fecha4)).")";
if($tipo4==1){    
    $fecha=strtotime($d1);
    $vendedor1=$vendedor2;
} 
$fecha3=$row['fecha_emision'];
$d3 = explode("-",$fecha3);
$dia=date("d",strtotime($fecha3));
$mes=$d3[1];  
$ano=$d3[0];
$d2=$ano."-".$mes."-".$dia;
$dd6=$dia."-".$mes."-".$ano." (".date("H:i",strtotime($fecha3)).")";
if($tipo4==0){
    $fecha=strtotime($d2);
    $vendedor1=$row['nombres'];

}
$fecha5=$row['saliente'];
$d5 = explode("-",$fecha3);
$dia2=date("d",strtotime($fecha5));
$mes2=$d5[1];  
$ano2=$d5[0];
$d3=$ano2."-".$mes2."-".$dia2;
$dd7=$dia2."-".$mes2."-".$ano2." (".date("H:i",strtotime($fecha5)).")";        
$nombre_cliente=$row['nombre_cliente']; 
$cancelado=$row['cancelado']; 
$tienda=$row['tienda'];
$nombre_vendedor=$row['nombres'];
$pre_ser=$row['pre_ser'];
$ade_ser=$row['ade_ser'];
$entregado=$row['entregado'];
$tipo1=$row['tipo'];
if($tipo1==1){
    $t2="Laptops";
}
if($tipo1==2){
    $t2="Computadoras";
}
if($tipo1==3){
    $t2="Impresoras";
}
if($tipo1==4){
    $t2="Monitores";
}
if($ter_ser==0){   
 $ter_ser1="No reparado";  
}
if($ter_ser==1){
$ter_ser1="Reparado";     
}
if($entregado==0){
$entregado1="Taller";     
}
if($entregado==1){
$entregado1="Entregado";     
}
if ($cancelado==1){$text_estado="Cancelado";$label_class='';}
else{$text_estado="Sin Cancelar";$label_class='';}
$total_venta=$row['pre_ser'];
$fech1=strtotime($dd1);
$fech2=strtotime($dd2);
if($d<>""){
    if($cliente==$vendedor1 && $tipo1>=$tipo3 && $tipo1<=$tipo2 && $fecha>=$fech1 && $fecha<=$fech2 && $tienda>=$tienda1 && $tienda<=$tienda2 && $ter_ser==$tipo4){
        $total1=$total1+$total_venta;
        ?>
                  
        <tr id="valor1">
       
                    <td class=" "><?php echo $numero_factura;?></td>
                    <td class=" "><?php echo $t2;?></td> 
                    <td class=" "><?php echo $nombre_cliente;?></td>
                    <td class=" "><?php print"$dd6";?></td>
                    <td class=" "><?php echo $nombre_vendedor;?></td>
                    <td class=" "><?php echo $total_venta;?></td>
                    <td class=" "><?php echo $ter_ser1;?></td>
                    <td class=" "><?php echo $id_reparado1;?></td>
                    <td class=" "><?php echo $dd5;?></td>
                    <td class=" "><?php echo $entregado1;?></td>
                    <td class=" "><?php echo $id_entregado1;?></td>
                    <td class=" "><?php print"$dd6";?></td>
        </tr>                
    <?php   
}}  else{
    
    if($tipo1>=$tipo3 && $tipo1<=$tipo2 && $fecha>=$fech1 && $fecha<=$fech2 && $tienda>=$tienda1 && $tienda<=$tienda2 && $ter_ser==$tipo4){
    $total1=$total1+$total_venta;
    ?>
    <tr id="valor1">
            <td class=" "><?php echo $numero_factura;?></td>
            <td class=" "><?php echo $t2;?></td>
            <td class=" "><?php echo $nombre_cliente;?></td>
            <td class=" "><?php print"$dd5";?></td>
            <td class=" "><?php echo $nombre_vendedor;?></td>
            <td class=" "><?php $total_venta=number_format($total_venta,2);print"S/.";echo $total_venta;?></td>
            <td class=" "><?php echo $ter_ser1;?></td>
            <td class=" "><?php echo $entregado1;?></td>
    </tr>                
    <?php
    }  
}
}                       
    ?>
                <tr><td><font color="white">99999999</font></td><td>-</td><td>-</td><td>-</td><td><font color="red">Total</font></td><td><font color="red"><?php echo $total1;?></font></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    
                </tbody>

                </table>
                
                    </form>
                </div>
    
            </div>
       
          </div>
    
      </div>
      
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      
        var data =[
        <?php
        for($i = 0;$i<count($usuario);$i++){
        ?>
        '<?php echo $usuario[$i];?>',
        <?php } ?>];
        var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
        });
     
        $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
<script src="js/select/select2.full.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        language: {
        "url": "/dataTables/i18n/de_de.lang",
                "decimal": "",
        "show": "Mostrar",
        "emptyTable": "No hay informacion",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        buttons: {
                copyTitle: 'Copiar filas al portapapeles',
                
                copySuccess: {
                    _: 'Copiado %d fias ',
                    1: 'Copiado 1 fila'
                },
                
                pageLength: {
                _: "Mostrar %d filas",
                '-1': "Mostrar Todo"
            }
            },
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
     
    },
         bDestroy: true,
            dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
        ],
        buttons: 
        [
                
                {
                    extend: 'pageLength',
                    text: 'Mostrar filas',
                    className: 'orange'
                },
                
                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red'
                },           
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1'
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2'
                }
            ],     
    } );
} );
</script>
</body>
</html>




