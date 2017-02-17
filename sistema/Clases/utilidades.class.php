<?php
	class utilidades
	{
		function conectar()
		{
			$conexion=@mysql_connect("localhost","root","");
			if (!$conexion) {
				echo "No se pudo conectar con el servidor";	
				return;
			}
			$bd=mysql_select_db("sistema_facturacion",$conexion);
			if (!$bd) {
				echo "No se pudo conectar con la base de datos";
				return;
			}	
			return $conexion;		
		}
		
		function mensaje($con,$res,$tabla)
		{
			if ($res) {
				echo "$tabla procesado satisfactoriamente";
			}
			else{
				$num_error=mysql_errno($con);
				echo "Error al procesar $tabla. Error $num_error";	
			}
		}
	}
?>