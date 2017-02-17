<?php
	require("../Clases/utilidades.class.php");
	require("../Clases/forma.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objForma=new forma();
	
	switch($_REQUEST["accion"]) {
		case "agregar_forma":
			$res=$objForma->agregar_forma($con,$_POST['cod_for'],$_POST['nom_for']);
			$objUtilidades->mensaje($con,$res,"Forma");
			$objForma->listar_forma($con);
			break;
			
		case "editar_forma":
			$res=$objForma->editar_forma($con,$_POST['cod_for'],$_POST['nom_for'],$_POST['est_for']);
			$objUtilidades->mensaje($con,$res,"Forma");
			break;
			
		case "listar_forma":
			$objForma->listar_forma($con);
			break;
			
		case "borrar_forma":
			$res=$objForma->borrar_forma($con,$_GET['cod_for']);
			$objUtilidades->mensaje($con,$res,"Forma");
			$objForma->listar_forma($con);
			break;
	}
?>