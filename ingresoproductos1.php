<?php

session_start();
include('menu.php');

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
date_default_timezone_set('America/Lima');
$fecha  = date("Y-m-d H:i:s");
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$cat_pro=$_POST['cat_pro'];
$estado=$_POST['estado'];
$pre_pro=$_POST['precio'];
$precio1=$_POST['precio1'];
$precio2=$_POST['precio2'];
$cos_pro=$_POST['costo'];
$multiplicando=$_POST['multiplicando'];
$cos_pro1=$cos_pro*$multiplicando;
$mon_costo=$multiplicando;
$mon_venta=1;
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$und_pro=$_POST['und_pro'];
$color=$_POST['color'];
$inventario=$_POST['inventario'];
$tienda=$_SESSION['tienda'];
$prod = array();
    for($i=1 ;$i<=6;$i++){
        if($i==$tienda){
          $prod[$i]=$inventario;
            
        }else{
           $prod[$i]=0; 
        }
        
    }
$aa=0;
$id_producto=0; 
$consulta2 = "SELECT * FROM products ";
$result2 = mysqli_query($con, $consulta2);
 while ($valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    if($valor2['nombre_producto']==$nombre){
    
    $aa=1;
   
    }
    $id_producto=$valor2['id_producto']+1;
    if($valor2['codigo_producto']==$codigo or $valor2['nombre_producto']==$nombre){
        $mensaje="Codigo o nombre del producto duplicado ";
    }
}
if(trim($nombre)=="" or trim($codigo)==""){
    $mensaje="Codigo o nombre del producto vacio";
}

 if($mensaje<>"") {
    ?>

<?php
    header("location:ingresoproductos.php?mensaje=$mensaje");
}else{

if($aa==1){
   ?>
<script language="JavaScript" type="text/javascript">
alert("este texto es el que modificas");
</script>
<?php
    header("location:ingresoproductos.php"); 
    
}else{
    
    $namefinal="nuevo.jpg";
    if(is_uploaded_file($_FILES['files']['tmp_name'])) {
    $ruta_destino = "fotos/";
        $namefinal="producto".$id_producto.".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
    if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
$consulta = "INSERT INTO products
            values (NULL, '$codigo', '$nombre', '$estado','$fecha','$pre_pro','$cos_pro1','$mon_costo','$mon_venta','$marca','$modelo','$color','$prod[1]','$prod[2]','$prod[3]','$prod[4]','$prod[5]','$prod[6]','$cat_pro','1','$namefinal','nuevo.jpg','nuevo.jpg','nuevo.jpg','0','$pre_pro','','','0','0','$precio1','$precio2','$und_pro')";
        if (mysqli_query($con, $consulta)) {
            header("location:productos.php");
        } else {
              die("No se pudo insertar..");
        }
      }
      }else{
        
          $consulta = "INSERT INTO products
            values (NULL, '$codigo', '$nombre', '$estado','$fecha','$pre_pro','$cos_pro1','$mon_costo','$mon_venta','$marca','$modelo','$color','$prod[1]','$prod[2]','$prod[3]','$prod[4]','$prod[5]','$prod[6]','$cat_pro','1','$namefinal','nuevo.jpg','nuevo.jpg','nuevo.jpg','0','$pre_pro','','','0','0','$precio1','$precio2','$und_pro')";
        if (mysqli_query($con, $consulta)) {
            header("location:productos.php");
        } else {
              die("No se pudo insertar..");
        } 
        
      }
        
        if($multiplicando>1){
            $consulta1 = "UPDATE datosempresa SET dolar=".$multiplicando;
            
            if (mysqli_query($con, $consulta1)) {
                header("location:productos.php");
            } else {
              die("No se pudo insertar..");
            }        
       }
        
}
}
?>



