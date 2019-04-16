<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$id_factura= intval($_GET['id_factura']);
        
	$sql_count=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_factura'];
        $folio=$rw_factura['folio'];
	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$condiciones=$rw_factura['condiciones'];
        $moneda=$rw_factura['moneda'];
        $estado=$rw_factura['estado_factura'];
        if($estado==1){
            $doc="Factura electronica";
        }
        if($estado==2){
            $doc="Boleta de Venta Electronica";
        }
        if($estado==3){
            $doc="Guia";
        }
        if($estado==5){
            $doc="Nota de Debito Electronico";
        }
        if($estado==6){
            $doc="Nota de Credito Electronico";
        }
        $total=$rw_factura['total_venta'];
        $deuda=$rw_factura['deuda_total'];
        $acuenta=$total-$deuda;
        
        $tienda2=$rw_factura['tienda'];
        
        if($condiciones==1){
            $condiciones1="Efectivo";
        }
        if($condiciones==2){
            $condiciones1="Cheque";
        }
        if($condiciones==3){
            $condiciones1="Transferencia Bancaria";
        }
        if($condiciones==4){
            $condiciones1="Credito";
        }
        
        $tienda1=$_SESSION['tienda'];
	//require_once(dirname(__FILE__).'/../html2pdf.class.php');
   
        
        $sql_factura1=mysqli_query($con,"select * from guia where id_doc='".$id_factura."'");
        $rw_factura1=mysqli_fetch_array($sql_factura1);
        $guia=$rw_factura1['guia'];
        
        $sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
        $rw_factura2=mysqli_fetch_array($sql_factura2);
        $logo=$rw_factura2['foto'];
        $dir=$rw_factura2['direccion'];
        $nombre=$rw_factura2['nombre'];
        $ruc=$rw_factura2['ruc'];
        $correo=$rw_factura2['correo'];
    
    
?>

<?php

if($tienda1==$tienda2){
    $sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    if($rw_cliente['doc']>0){
        $doc1=$rw_cliente['doc'];
        $tipo_doc="R.U.C";
    }
    if($rw_cliente['dni']>0){
        $doc1=$rw_cliente['dni'];
        $tipo_doc="D.N.I";
    }
    $sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
    $rw_cliente1=mysqli_fetch_array($sql_cliente1);
 
			?>

    
   <html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="ticket.css" rel="stylesheet" type="text/css">
<script>
    function printPantalla()
{
   document.getElementById('cuerpoPagina').style.marginRight  = "0";
   document.getElementById('cuerpoPagina').style.marginTop = "1";
   document.getElementById('cuerpoPagina').style.marginLeft = "1";
   document.getElementById('cuerpoPagina').style.marginBottom = "0"; 
   document.getElementById('botonPrint').style.display = "none"; 
   window.print();
}
</script>
</head>
<body id="cuerpoPagina">



<div class="zona_impresion">
        <!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        .::<strong> <?php echo $nombre; ?></strong>::.<br>
        R.U.C:<?php echo $ruc; ?><br>
       </td>
    </tr>
    <tr>
        <td align="center"><?php echo "Fecha/Hora: ".$fecha_factura; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <td><?php echo $doc; ?>: <?php $numero_factura2=str_pad($numero_factura, 8, "0", STR_PAD_LEFT);print"$folio-$numero_factura2"; ?></td>
    </tr> 
    <tr>
        <td>Cliente: <?php echo $rw_cliente['nombre_cliente']; ?></td>
    </tr>
     <tr>
        <td><?php echo $tipo_doc; ?>: <?php echo $doc1; ?></td>
    </tr>
    <?php
    if($rw_cliente['direccion_cliente']<>""){
        print"<tr><td>Dirección: $rw_cliente[direccion_cliente]</td></tr>";
    }
    ?>
  
    <?php
    if($estado==6 or $estado==5){
        print"<tr><td>Documento modifica: $rw_factura[doc_mod]</td></tr>";
    }
    
    
     $motivo=$rw_factura['motivo'];
     $r="";
    if($estado==6){
        if($motivo=="01") {
        $r="ANULACION DE LA OPERACION";
        }
        if($motivo=="02") {
        $r="ANULACION POR ERROR EN EL RUC";
        }
        if($motivo=="03") {
        $r="CORRECION POR ERROR EN LA DESCRIPCION";
        }
        if($motivo=="04") {
        $r="DESCUENTO GLOBAL";
        }
        if($motivo=="05") {
        $r="DESCUENTO POR ITEM";
        } 
        if($motivo=="06") {
        $r="DEVOLUCION TOTAL";
        }
        if($motivo=="07") {
        $r="DEVOLUCION POR ITEM";
        }        
        if($motivo=="08") {
            $r="BONIFICACION";
        }
        if($motivo=="09") {
        $r="DISMINUCION EN EL VALOR";
        }
    }
    if($estado==5){
        if($motivo=="01") {
           $r="INTERES POR MORA";
        }    
        if($motivo=="02") {
           $r="AUMENTO EN EL VALOR";
        }       
        if($motivo=="03") {
            $r="PENALIDADES";
        }          
    }
    
    
    if($estado==6 or $estado==5){
        print"<tr><td>Motivo: $r</td></tr>";
    }
    
    ?>
</table>
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td>CANT.</td>
        <td>DESCRIPCIÓN</td>
        <td>PUNITARIO</td>
        <td align="right">IMPORTE</td>
    </tr>
    <tr>
      <td colspan="4">==================================================</td>
    </tr>
     
    
 
    
<?php
$nums=1;
$sumador_total=0;
$sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
$row1=mysqli_fetch_array($sql1);
$servicio=$row1["servicio"];
$tipo1=$row1["estado_factura"];
$id_cliente=$row1["id_cliente"];

$numero_factura1=$row1["numero_factura"];
if($servicio==1){
$sql=mysqli_query($con, "select * from detalle_factura, facturas where  detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.numero_factura=$numero_factura1 and detalle_factura.tienda=$tienda1 and facturas.ven_com=detalle_factura.ven_com and detalle_factura.tipo_doc='".$tipo1."' and facturas.id_factura='".$id_factura."' and detalle_factura.id_cliente='".$id_cliente."'" );
}
$suma=0;
$codigo_producto="";
while ($row=mysqli_fetch_array($sql))
	{
	$id_producto=$row["id_producto"];
        $cantidad1=$row['cantidad'];
        $tipo=$row['tipo'];
        $id_producto1=$row['id_producto'];  
        $inv_ini=$row['inv_ini'];
        if($inv_ini>0){
            $sql2=mysqli_query($con, "select * from products where id_producto='".$id_producto1."'");
            $row2=mysqli_fetch_array($sql2);
            $nombre_producto=$row2["nombre_producto"];
            
        }
        else{
            $nombre_producto=$row['id_producto'];  
        }
            
       
	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad1;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
        
	
       
        ?>

        
	<?php 
        
        echo "<tr>";
        echo "<td>".$cantidad1."</td>";
        echo "<td>".$nombre_producto."</td>";
        echo "<td>".$precio_venta_f. "</td>";
        echo "<td align='right'>". $precio_total_f."</td>";
        echo "</tr>";
        $suma=$suma+1;
        
     
	}
        
         if($estado==1 or $estado==5 or $estado==6){
        
    
        ?>
     <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>OP. GRAV:</b></td>
    <td align="right"><b>S/.  <?php 
    if($tipo==0){
      echo $op_gravada=number_format($sumador_total/1.18,2,'.','');  
    }
    if($tipo==1){
      echo $op_gravada="0.00";  
    }
      ?></b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>IGV-18%:</b></td>
    <td align="right"><b>S/.  
    <?php 
    if($tipo==0){
        echo $sumaigv=number_format(0.18*($sumador_total/1.18),2,'.','');  
    }
    if($tipo==1){
        echo $sumaigv="0.00";  
    }
    ?>
        </b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>EXONERADA%:</b></td>
    <td align="right"><b>S/.  
    <?php 
    if($tipo==1){
        echo $sumaigv=number_format($sumador_total,2,'.',''); 
    }
    if($tipo==0){
        echo $sumaigv="0.00";  
    }
    ?>
        </b></td>
    </tr>
    <?php }
    
    ?>
    
     <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>TOTAL:</b></td>
    <td align="right"><b>S/.  <?php echo $subtotal=number_format($sumador_total,2,'.','');  ?></b></td>
    </tr>
    <?php
    if($condiciones==4){
        ?>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
    
    
    <td align="right"><b>A CUENTA:</b></td>
    <td align="right"><b>S/.  <?php echo number_format($acuenta,2,'.','');  ?></b></td>
    </tr>
    
    <?php
    }
    if($estado<=2 or $estado==5 or $estado==6){
    ?>
     <tr>
    <td colspan="1"><img src="qr/<?php echo $id_factura;?>.png" width="25" height="25"></td>
    
    <td colspan="3">Autorizado mediante Resolución de Intendencia N° 032-
            005 Representación impresa de la <?php echo $doc;?>.
            Consulte su documento electrónico en: <br><span style="font-size: 14px">http://ofertasde.net/sistemas</span>
    <BR>HASH:<br><?php echo $rw_factura['cod_hash'];?></td>
    </tr>
    
    <?php
    }
    if($condiciones<>4){
        ?>
    <tr>
      <td colspan="4" align="center">Cancelado</td>
    </tr>
    <?php
    }
    ?>
    
    <tr>
      <td colspan="3">Nº de artículos: <?php echo $suma ?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="4" align="center">¡Gracias por su compra!</td>
    </tr>
    
    
</table>
<br>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>
  
<div style="margin-left:245px;"><a href="#" id="botonPrint" onClick="printPantalla();"><img src="printer.png" border="0" style="cursor:pointer" title="Imprimir"></a></div>
</body>
</html>

<?php

}
?>


