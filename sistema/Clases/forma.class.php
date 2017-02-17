<?php
	class forma
	{
		function agregar_forma ($con,$cod_for,$nom_for) 
		{
			$sql = "insert into forma_pago(cod_for,nom_for,est_for) 
				values('$cod_for','$nom_for','A')";
			return mysql_query($sql,$con);
		}
		
		function listar_forma($con)
		{
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			$sql="select * from forma_pago";
			$ok=mysql_query($sql,$con);
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Codigo</td>
					<td align='center'>Nombre</td>
					<td align='center'>Estatus</td>
					<td align='center'>Editar</td>
					<td align='center'>Borrar</td>
				 </tr>";
			while ($forma=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$forma['cod_for']."</td>";
					echo "<td align='center'>".utf8_encode($forma['nom_for'])."</td>";
					echo "<td align='center'>".$forma['est_for']."</td>";
					echo "<td align='center'>
							<a href='../Pantallas/editar_forma.php?cod_for=$forma[cod_for]'>
								<img src='../Imagenes/editar.png'>
							</a>
						  </td>";
					echo "<td align='center'><a href='../Controladores/controlador_forma.php?cod_for=$forma[cod_for]&accion=borrar_forma'><img src='../Imagenes/borrar.png'></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		function buscar_forma($con,$cod_for)
		{
			$sql="select * from forma_pago where cod_for='$cod_for'";
			$ok=mysql_query($sql,$con);	
			return mysql_fetch_assoc($ok);
		}
		
		function editar_forma($con,$cod_for,$nom_for,$est_for)
		{
			$sql="update forma_pago set 
					nom_for='$nom_for', 						                   
					est_for='$est_for' 
					where cod_for='$cod_for'";
			$ok=mysql_query($sql,$con);
			return mysql_affected_rows($con);
		}
		
		function borrar_forma($con,$cod_for)
		{
			$sql="delete from forma_pago where cod_for='$cod_for'";
			$ok=mysql_query($sql,$con);	
			return mysql_affected_rows($con);
		}
		
		function obtener_formas($con)
		{
			$sql = "select * from forma_pago";
			$ok=mysql_query($sql,$con);
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<select name='nom_for' id='nom_for' class='inp'>";
			while($forma = mysql_fetch_assoc($ok)) {
				echo "<option value='".$forma['cod_for']."'>".$forma['nom_for']."</option>";
			}	
			echo "</select>";
		}
	}
?>