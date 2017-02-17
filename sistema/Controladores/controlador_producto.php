<?php
	require("../Clases/utilidades.class.php");
	require("../Clases/producto.class.php");
	$objUtilidades = new utilidades();
	$con=$objUtilidades->conectar(); 
	$objProducto = new producto();

	switch($_REQUEST["accion"]) {
		case "agregar_producto":
			$res=$objProducto->agregar_producto($con,$_POST["cod_pro"],$_POST["nom_pro"],$_POST["pre_pro"],$_POST["exi_pro"]
			);		
			$objUtilidades->mensaje($con,$res,"Producto");
			$objProducto->listar_producto($con);
			break;
			
		case "editar_producto":
			$res=$objProducto->editar_producto($con,$_POST["cod_pro"],$_POST["nom_pro"],$_POST["pre_pro"],$_POST["exi_pro"],
				$_POST["est_pro"]);
			$objUtilidades->mensaje($con,$res,"Producto");
			break;
			
		case "listar_producto":
			$objProducto->listar_producto($con);
			break;
			
		case "borrar_producto":
			$res=$objProducto->borrar_producto($con,$_GET["cod_pro"]);
			$objUtilidades->mensaje($con,$res,"Producto");
			$objProducto->listar_producto($con);
			break;
		case "buscar_producto":
			$res=$objProducto->buscar_producto($con,$_GET["cod_pro"]);
			if ($res) 
				echo $res["cod_pro"].";".$res["nom_pro"].";".$res["pre_pro"].";".$res["exi_pro"];
			else
				echo false;
			break;
	}
?>