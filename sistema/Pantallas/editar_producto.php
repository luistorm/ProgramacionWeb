<?php
	require("../Clases/producto.class.php");
	require("../Clases/utilidades.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objProducto=new producto();
	$producto=$objProducto->buscar_producto($con,$_GET["cod_pro"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Productos</title>
	<meta charset="utf-8">
    <link href="../CSS/estilos.css" rel="stylesheet" type="text/css">
    <script src="../JavaScript/producto.js" type="text/javascript" language="javascript"></script>
    <script src="../JavaScript/utlidades.js" type="text/javascript" language="javascript"></script>
</head>
<body>
	<form action="../Controladores/controlador_producto.php" method="post" id="fomulario">
		<input type="hidden" name="accion" value="editar_producto">
		<table align="center" class="tab_for">
			<tr>
				<td class="titulo" colspan="2" align="center">Editar Producto</td>
			</tr>
			<tr>
				<td>Codigo: </td>
				<td>
					<input type="text" name="cod_pro" id="cod_pro" maxlength="15" size="15" placeholder="PXXX" class="inp" 
					value="<?php echo $producto['cod_pro']; ?>" readonly> 
				</td>
			</tr>
				<td>Nombre: </td>
				<td>
					<input class="inp" type="text" name="nom_pro" id="nom_pro" maxlength="50" size="50" placeholder="Salsa de Tomate" 
					value="<?php echo $producto['nom_pro']; ?>">
				</td>
			<tr>
				<td>Precio: </td>
				<td>
					<input class="inp" type="text" name="pre_pro" id="pre_pro" placeholder="15.32 Bs"
					value="<?php echo $producto['pre_pro']; ?>">	
				</td>
			</tr>
			<tr>
				<td>Cantidad en Existencia: </td>
				<td>
					<input class="inp" type="text" name="exi_pro" id="exi_pro" placeholder="3000 unid | 4 gr | 5 lts"
					value="<?php echo $producto['exi_pro']; ?>" onKeyPress="return validar_numeros(event)">	
				</td>
			</tr>
			<tr>
                <td>Estatus: </td>
                <td>
                	<?php 
						if ($producto["est_pro"]=="A")
							echo '<input type="radio" name="est_pro" value="A" checked>Activo
								<input type="radio" name="est_pro" value="I">Inactivo';
						else
							echo '<input type="radio" name="est_pro" value="A">Activo
								<input type="radio" name="est_pro" value="I" checked>Inactivo';
					?>
                </td>
            </tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" value="Guardar" name="btn_gua" id="btn_gua" onClick="validar_producto()">
				</td>
			</tr>	
		</table>
	</form>
</body>
</html>