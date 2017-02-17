<?php
	require("../Clases/utilidades.class.php");
	require("../Clases/cliente.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objCliente=new cliente();
	switch($_REQUEST["accion"]) {
		case "agregar_cliente":
			$res=$objCliente->agregar_cliente($con,$_POST["ide_cli"],$_POST["nom_cli"],$_POST["dir_cli"],$_POST["tel_cli"]);
			$objUtilidades->mensaje($con,$res,"Cliente");
			$objCliente->listar_cliente($con);
			break;
			
		case "editar_cliente":
			$res=$objCliente->editar_cliente($con,$_POST["cod_cli"],$_POST["ide_cli"],$_POST["nom_cli"],$_POST["dir_cli"],$_POST["tel_cli"],
				$_POST["est_cli"]);
			$objUtilidades->mensaje($con,$res,"Cliente");
			break;
			
		case "listar_cliente":
			$objCliente->listar_cliente($con);
			break;
			
		case "borrar_cliente":
			$res=$objCliente->borrar_cliente($con,$_GET["cod_cli"]);
			$objUtilidades->mensaje($con,$res,"Cliente");
			//header("Location:controlador_cliente.php?accion=listar_cliente");
			$objCliente->listar_cliente($con);
			break;
		
		case "buscar_cliente":
			$res=$objCliente->buscar_cliente($con,$_GET["ide_cli"]);
			if ($res) 
				echo $res["cod_cli"].";".$res["nom_cli"].";".$res["dir_cli"].";".$res["tel_cli"];
			else
				echo false;
			break;
	}
?>