<?php
	class cliente
	{
		function agregar_cliente ($con,$ide_cli,$nom_cli,$dir_cli,$tel_cli) 
		{
			/*
				Inserccion en un tabla:
				INSERT INTO "NOMBRE_TABLA"(COL1,COL2,COL3,...,COLN) VALUES("V1","V2",...,"VN");
				Si la variable e la DB es varchar, char o date se usan comillas.
				
				Query:
				$sql = insert into cliente(ide_cli,nom_cli,dir_cli,tel_cli,est_cli) 
				values('$ide_cli','$nom_cli','$dir_cli','$tel_cli','A');
			*/
			$sql = "insert into cliente(ide_cli,nom_cli,dir_cli,tel_cli,est_cli) 
				values('$ide_cli','$nom_cli','$dir_cli','$tel_cli','A')";
			return mysql_query($sql,$con);
		}
		
		function listar_cliente($con)
		{
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			$sql="select * from cliente";
			$ok=mysql_query($sql,$con);
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Cod cliente</td>
					<td align='center'>ID</td>
					<td align='center'>Nom/Razon</td>
					<td align='center'>Teléfono</td>
					<td align='center'>Estatus</td>
					<td align='center'>Editar</td>
					<td align='center'>Borrar</td>
				 </tr>";
			while ($cliente=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$cliente['cod_cli']."</td>";
					echo "<td align='center'>".$cliente['ide_cli']."</td>";
					echo "<td align='center'>".utf8_encode($cliente['nom_cli'])."</td>";
					echo "<td align='center'>".$cliente['tel_cli']."</td>";
					echo "<td align='center'>".$cliente['est_cli']."</td>";
					echo "<td align='center'>
							<a href='../Pantallas/editar_cliente.php?cod_cli=$cliente[cod_cli]'>
								<img src='../Imagenes/editar.png'>
							</a>
						  </td>";
					echo "<td align='center'><a href='../Controladores/controlador_cliente.php?cod_cli=$cliente[cod_cli]&accion=borrar_cliente'><img src='../Imagenes/borrar.png'></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		function buscar_cliente($con,$cli)
		{
			$sql="select * from cliente where ide_cli='$cli' or cod_cli=$cli";
			$ok=mysql_query($sql,$con);	
			return mysql_fetch_assoc($ok);
		}
		
		function editar_cliente($con,$cod_cli,$ide_cli,$nom_cli,$dir_cli,$tel_cli,$est_cli)
		{
			$sql="update cliente set 
					ide_cli='$ide_cli',
					nom_cli='$nom_cli', 
					dir_cli='$dir_cli', 
					tel_cli='$tel_cli', 						                   
					est_cli='$est_cli' 
					where cod_cli=$cod_cli";
			$ok=mysql_query($sql,$con);
			return mysql_affected_rows($con);
		}
		
		function borrar_cliente($con,$cod_cli)
		{
			$sql="delete from cliente where cod_cli=$cod_cli";
			$ok=mysql_query($sql,$con);	
			return mysql_affected_rows($con);
		}
	}
?>