<?php 
	class producto
	{
		function agregar_producto ($con,$cod_pro,$nom_pro,$pre_pro,$exi_pro)
		{
			$sql = "insert into producto(cod_pro,nom_pro,pre_pro,exi_pro,est_pro) 
				values('$cod_pro','$nom_pro','$pre_pro','$exi_pro','A')";
			return mysql_query($sql,$con);	
		}	

		function listar_producto($con)
		{
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			$sql="select * from producto";
			$ok=mysql_query($sql,$con);
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Cod Producto</td>
					<td align='center'>Nombre</td>
					<td align='center'>Precio</td>
					<td align='center'>Existencia</td>
					<td align='center'>Estatus</td>
					<td align='center'>Editar</td>
					<td align='center'>Borrar</td>
				 </tr>";
			while ($producto=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$producto['cod_pro']."</td>";
					echo "<td align='center'>".utf8_encode($producto['nom_pro'])."</td>";
					echo "<td align='center'>".$producto['pre_pro']."</td>";
					echo "<td align='center'>".$producto['exi_pro']."</td>";
					echo "<td align='center'>".$producto['est_pro']."</td>";
					echo "<td align='center'>
							<a href='../Pantallas/editar_producto.php?cod_pro=$producto[cod_pro]'>
								<img src='../Imagenes/editar.png'>
							</a>
						  </td>";
					echo "<td align='center'><a href='../Controladores/controlador_producto.php?cod_pro=$producto[cod_pro]&accion=borrar_producto'><img src='../Imagenes/borrar.png'></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		function buscar_producto($con,$pro)
		{
			$sql="select * from producto where upper(cod_pro)='$pro' or upper(nom_pro)=upper('$pro')";
			$ok=mysql_query($sql,$con);	
			if(!$ok)
				echo "error en query";
			return mysql_fetch_assoc($ok);
		}
		
		function editar_producto($con,$cod_pro,$nom_pro,$pre_pro,$exi_pro,$est_pro)
		{
			$sql="update producto set 
					nom_pro='$nom_pro', 
					pre_pro=$pre_pro,
					exi_pro=$exi_pro, 						                   
					est_pro='$est_pro' 
					where cod_pro='$cod_pro'";
			$ok=mysql_query($sql,$con);
			return mysql_affected_rows($con);
		}
		
		function borrar_producto($con,$cod_pro)
		{
			$sql="delete from producto where cod_pro='$cod_pro'";
			$ok=mysql_query($sql,$con);	
			return mysql_affected_rows($con);
		}
	}
?>