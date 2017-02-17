<?php
	require("../Clases/utilidades.class.php");
	require("../Clases/detalles.class.php");
	$objUtilidades = new utilidades();
	$con=$objUtilidades->conectar(); 
	$objDetalle = new detalle();
	if($_GET["accion"] == "agregar_detalle") {
			$res = $objDetalle->agregar_detalle($con,$_GET["cod_pro"],$_GET["can_pro"],$_GET["pre_pro"],$_GET["imp_pro"],$_GET["tot_det"]);
			$objUtilidades->mensaje($con,$res,"Detalle");
	}
?>