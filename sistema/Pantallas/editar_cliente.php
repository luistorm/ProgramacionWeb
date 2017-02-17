<?php
	require("../Clases/cliente.class.php");
	require("../Clases/utilidades.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objCliente=new Cliente();
	$cliente=$objCliente->buscar_cliente($con,$_GET["cod_cli"]);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro Clientes</title>
    <meta charset="utf-8">
    <link href="../CSS/estilos.css" rel="stylesheet" type="text/css">
    <script src="../JavaScript/cliente.js" type="text/javascript" language="javascript"></script>
    <script src="../JavaScript/utilidades.js" type="text/javascript" language="javascript"></script>
</head>
<body>
	<form action="../Controladores/controlador_cliente.php" method="post" id="formulario"> <!--../ significa salgase una carpeta -->
        <input type="hidden" name="accion" value="editar_cliente">
        <table align="center" class="tab_for">
            <tr>
                <td colspan="2" align="center" class="titulo">Editar cliente</td>
            </tr>
            <tr>
                <td>Codigo Cliente :</td>
                <td>
                    <input type="text" name="cod_cli" id="cod_cli" class="inp" maxlength="1" size="1" placeholder="Codigo" value="<?php echo $cliente["cod_cli"] ?>" readonly> 
                </td>
            </tr>
            <tr>
                <td>Identificación :</td>
                <td>
                    <input type="text" name="ide_cli" id="ide_cli" class="inp" maxlength="12" size="12" placeholder="Cédula/RIF" value="<?php echo $cliente["ide_cli"] ?>"> <!-- El Name lo pide PHP y el id lo pide JS/CSS-->
                </td>
            </tr>
            <tr>
                <td>Razón Social: </td>
                <td>
                    <input type="text" name="nom_cli" id="nom_cli" class="inp" maxlength="60" size="60" placeholder="Nombre Persona/Empresa" value="<?php echo utf8_encode($cliente["nom_cli"]) ?>">
                </td>
            </tr>
            <tr>
                <td>Dirección: </td>
                <td>
                    <textarea name="dir_cli" id="dir_cli" maxlength="100" class="inp" rows="4" cols="50" placeholder="Direccion" ><?php echo $cliente["dir_cli"] ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Teléfono: </td>
                <td>
                    <input type="text" name="tel_cli" id="tel_cli" class="opcional" class="inp" maxlength="15" size="15" placeholder="Ej:04xx-xxxxxxx"
                    onkeypress="return validar_numeros(event)" value="<?php echo $cliente["tel_cli"] ?>">	
                </td>
            </tr>
            <tr>
                <td>Estatus: </td>
                <td>
                	<?php 
						if ($cliente["est_cli"]=="A")
							echo '<input type="radio" name="est_cli" value="A" checked>Activo
								<input type="radio" name="est_cli" value="I">Inactivo';
						else
							echo '<input type="radio" name="est_cli" value="A">Activo
								<input type="radio" name="est_cli" value="I" checked>Inactivo';
					?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Guardar" onClick="validar_cliente()">
                </td>
            </tr>	
        </table>
	</form>
</body>
</html>