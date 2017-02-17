<?php
	class factura 
	{
		function agregar_factura ($con,$fec_fac,$cli_fac,$for_fac,$bas_fac,$imp_fac,$tot_fac) 
		{
			$sql = "insert into factura(fec_fac,cli_fac,for_fac,bas_fac,imp_fac,tot_fac,est_fac) 
				values(STR_TO_DATE('$fec_fac','%d-%m-%Y'),$cli_fac,'$for_fac',$bas_fac,$imp_fac,$tot_fac,'A')";
			if (mysql_query($sql,$con)) 
				return mysql_insert_id($con);
		}
		
		function agregar_producto ($con,$cod_pro,$can_pro,$pre_pro,$imp_pro,$tot_det,$cod_fac)
		{
			$sql = "insert into detalle_factura(num_fac,cod_pro,can_pro,pre_pro,imp_pro,tot_det)
					values ($cod_fac,'$cod_pro',$can_pro,$pre_pro,$imp_pro,$tot_det)";
			return mysql_query($sql,$con);
		}
		
		function listar_facturas ($con)	
		{
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			$sql="select * from factura";
			$ok=mysql_query($sql,$con);
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Cod Factura</td>
					<td align='center'>Cod Cliente</td>
					<td align='center'>Forma de Pago</td>
					<td align='center'>Subtotal</td>
					<td align='center'>Impuesto</td>
					<td align='center'>Total</td>
					<td align='center'>Estatus</td>
					<td align='center'>Editar</td>
					<td align='center'>Borrar</td>
				 </tr>";
			while ($factura=mysql_fetch_assoc($ok)) {
				echo "<tr>";
					echo "<td align='center'>".$factura['num_fac']."</td>";
					echo "<td align='center'>".$factura['cli_fac']."</td>";
					echo "<td align='center'>".$factura['for_fac']."</td>";
					echo "<td align='center'>".$factura['bas_fac']."</td>";
					echo "<td align='center'>".$factura['imp_fac']."</td>";
					echo "<td align='center'>".$factura['tot_fac']."</td>";
					echo "<td align='center'>".$factura['est_fac']."</td>";
					echo "<td align='center'>
							<a href='controlador_factura.php?num_fac=$factura[num_fac]&accion=editar_factura'>
								<img src='../Imagenes/editar.png'>
							</a>
						  </td>";
					echo "<td align='center'><a href='controlador_factura.php?num_fac=$factura[num_fac]&accion=borrar_factura'><img src='../Imagenes/borrar.png'></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		function detallar_factura($con,$num_fac) 
		{
			$sql = "select * from factura where num_fac=$num_fac";
			$ok=mysql_query($sql,$con);	
			$factura=mysql_fetch_assoc($ok);
			$sql = "select * from forma_pago where cod_for='$factura[for_fac]'";
			$ok=mysql_query($sql,$con);	
			$forma=mysql_fetch_assoc($ok);
			$sql = "select * from cliente where cod_cli=$factura[cli_fac]";
			$ok=mysql_query($sql,$con);	
			$cliente=mysql_fetch_assoc($ok);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table align='center' class='tab_for'>
			<tr>
				<td colspan='2' align='center' class='titulo'>Factura $factura[num_fac] ($factura[est_fac])</td>
			</tr>
			<tr>
				<td width='20%'>Fecha Factura: </td>
				<td><input type='text' class='inp' value='$factura[fec_fac]' size='10' readonly disabled></td>
			</tr>
			<tr>
				<td>Forma de Pago: </td>
				<td><input type='text' class='inp' value='$forma[nom_for]' size='10' readonly disabled></td>
			</tr>
			<tr>
				<td>Cedula/RIF Cliente: </td>
				<td><input type='text' class='inp' size='20' maxlength='15' value='$cliente[ide_cli]' disabled></td>
			</tr>
			<tr>
				<td>Nombre o Razón Social: </td>
				<td><input type='text' size='60' maxlength='60' disabled class='inp' value='$cliente[nom_cli]'></td>
			</tr>
			<tr>
				<td>Dirección: </td>
				<td><textarea rows='4' cols='50' disabled class='inp'>$cliente[dir_cli]</textarea></td>
			</tr>
			<tr>
				<td>Teléfono: </td>
				<td><input type='text' size='60' maxlength='60' disabled class=inp' value='$cliente[tel_cli]'> </td>
			</tr>
		</table>";
			echo "<table align='center' class='tab_for'>
				<tr>
					<td colspan='5' align='center' class='titulo'>Detalles</td>
				</tr>
				<tr>
					<td align='center' class='titulo'>Producto</td>
					<td align='center' class='titulo'>Cantidad</td>
					<td align='center' class='titulo'>Precio</td>
					<td align='center' class='titulo'>Impuesto</td>
					<td align='center' class='titulo'>Total</td>
				</tr>";
				
			$sql = "select * from detalle_factura where num_fac=$factura[num_fac]";
			$ok = mysql_query($sql,$con);
			while ($detalle=mysql_fetch_assoc($ok)) {
				$sql2 = "select * from producto where cod_pro='$detalle[cod_pro]'";
				$ok2 = mysql_query($sql2,$con);
				$producto = mysql_fetch_assoc($ok2);
				echo "<tr>
                <td align='center'><input type='text' size='15' maxlength='15' class='inp' value='$producto[nom_pro]' disabled></td>
                <td align='center'><input type='number' min='0' size='15' maxlength='15' class='inp' value='$detalle[can_pro]' disabled></td>
                <td align='center'><input type='text' disabled size='10' maxlength='10' class='inp' value='$detalle[pre_pro]'></td>
				<td align='center'><input type='text' disabled size='10' maxlength='10' class='inp' value='$detalle[imp_pro]'></td>
                <td align='center'><input type='text' size='10' maxlength='10' readonly class='inp' disabled value='$detalle[tot_det]'></td>
            </tr>";
			}
			echo "</table>";
			echo "<table align='center' class='tab_for'>
    	<tr align='center'>
        	<td width='80%' align='right'>Subtotal: </td>
            <td><input type='text' value='$factura[bas_fac]' disabled size='10' class='inp'></td>
        </tr>
        <tr align='center'>
        	<td align='right'>Impuesto: </td>
            <td><input type='text' value='$factura[imp_fac]' disabled size='10' class='inp'></td>
        </tr>
        <tr align='center'>
        	<td align='right'>Total: </td>
            <td><input type='text' value='$factura[tot_fac]' disabled size='10' class='inp'></td>
        </tr>
    </table>";
		}
		
		function factura_mas_costosa($con) 
		{
			$sql = "select * from factura fac
					having fac.tot_fac =
					(
						select max(fac2.tot_fac) from factura fac2
    
					)";
			$ok = mysql_query($sql,$con);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Cod Factura</td>
					<td align='center'>Cod Cliente</td>
					<td align='center'>Forma de Pago</td>
					<td align='center'>Subtotal</td>
					<td align='center'>Impuesto</td>
					<td align='center'>Total</td>
					<td align='center'>Estatus</td>
				 </tr>";
			while ($factura=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$factura['num_fac']."</td>";
					echo "<td align='center'>".$factura['cli_fac']."</td>";
					echo "<td align='center'>".$factura['for_fac']."</td>";
					echo "<td align='center'>".$factura['bas_fac']."</td>";
					echo "<td align='center'>".$factura['imp_fac']."</td>";
					echo "<td align='center'>".$factura['tot_fac']."</td>";
					echo "<td align='center'>".$factura['est_fac']."</td>";
			}
			echo "</table>";
			
		}
		
		function clientes_fieles($con)
		{
			$sql = "select cli.nom_cli as nom,cli.ide_cli as ide,count(*) as cant from cliente cli 
					join factura fac on (fac.cli_fac=cli.cod_cli)
					group by cli.cod_cli
					having count(*) = (
						select max(cant) from 
						(
							select count(*) as cant from cliente cli2
							join factura fac2 on (fac2.cli_fac=cli2.cod_cli)
							group by cli2.cod_cli
						) as cantidades
					)";
			$ok = mysql_query($sql,$con);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Nombre Cliente</td>
					<td align='center'>ID Cliente</td>
					<td align='center'>Cantidad de Facturas</td>
				 </tr>";
			while ($fila=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$fila['nom']."</td>";
					echo "<td align='center'>".$fila['ide']."</td>";
					echo "<td align='center'>".$fila['cant']."</td>";
			}
			echo "</table>";
		}
		
		function mejores_cientes($con) 
		{
			$sql = "select cli.nom_cli as nom,cli.ide_cli as ide, sum(fac.tot_fac) as tot from cliente cli
					join factura fac on (fac.cli_fac=cli.cod_cli)
					group by cli.cod_cli
					having sum(fac.tot_fac) =
					(
						select max(gastado) from 
						(
							select sum(fac2.tot_fac) as gastado from cliente cli2
							join factura fac2 on (fac2.cli_fac=cli2.cod_cli)
							group by cli2.cod_cli
						) as Mayores
					)";
			$ok = mysql_query($sql,$con);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Nombre Cliente</td>
					<td align='center'>ID Cliente</td>
					<td align='center'>Total Gastado</td>
				 </tr>";
			while ($fila=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$fila['nom']."</td>";
					echo "<td align='center'>".$fila['ide']."</td>";
					echo "<td align='center'>".$fila['tot']."</td>";
			}
			echo "</table>";
		}
		
		function formas_mas_usadas($con) 
		{
			$sql = "select forma.nom_for as nom,count(*) as cant from forma_pago forma
					join factura fac on (fac.for_fac=forma.cod_for)
					group by forma.cod_for
					order by cant desc";
			$ok = mysql_query($sql,$con);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Nombre Forma</td>
					<td align='center'>Cantidad de Usos</td>
				 </tr>";
			while ($fila=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$fila['nom']."</td>";
					echo "<td align='center'>".$fila['cant']."</td>";
			}
			echo "</table>";			
		}
		
		function mas_comprados($con)
		{
			$sql = "select pro.nom_pro as nom, count(*) as cant from producto pro
					join detalle_factura det on (det.cod_pro=pro.cod_pro)
					group by pro.cod_pro
					order by 2 desc";
			$ok = mysql_query($sql,$con);
			echo "<meta charset='utf-8'>";
			echo "<link href='../CSS/estilos.css' rel='stylesheet' type='text/css'>";
			echo "<table class='tab_for' align='center' class='lista'>";
			echo "<tr class='titulo' class='fil_list'>
					<td align='center'>Nombre Producto</td>
					<td align='center'>Cantidad de Veces que lo han llevado</td>
				 </tr>";
			while ($fila=mysql_fetch_assoc($ok)) {
				echo "<tr class='zoom'>";
					echo "<td align='center'>".$fila['nom']."</td>";
					echo "<td align='center'>".$fila['cant']."</td>";
			}
			echo "</table>";
		}
	}
?>