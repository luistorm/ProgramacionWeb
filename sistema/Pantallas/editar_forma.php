<?php
	require("../Clases/forma.class.php");
	require("../Clases/utilidades.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objForma=new forma();
	$forma=$objForma->buscar_forma($con,$_GET["cod_for"]);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <link href="../CSS/estilos.css" rel="stylesheet" type="text/css">
<title>Registro Formas de Pago</title>
</head>

<body>
	<form action="../Controladores/controlador_forma.php" method="post"> <!--../ significa salgase una carpeta -->
        <input type="hidden" name="accion" value="editar_forma">
        <table align="center" class="tab_for">
            <tr>
                <td colspan="2" align="center" class="titulo">Registrar Forma de pago</td>
            </tr>
            <tr>
                <td>Codigo: </td>
                <td>
                    <input type="text" name="cod_for" id="cod_for" class="inp" maxlength="4" size="4" value="<?php echo $forma['cod_for'] ?>">
                </td>
            </tr>
            <tr>
                <td>Nombre: </td>
                <td>
                    <input type="text" name="nom_for" id="nom_for" class="inp" maxlength="30" size="30" value="<?php echo $forma['nom_for'] ?>">
                </td>
            </tr>
            <tr>
                <td>Estatus: </td>
                <td>
                	<?php 
						if ($forma["est_for"]=="A")
							echo '<input type="radio" name="est_for" value="A" checked>Activo
								<input type="radio" name="est_for" value="I">Inactivo';
						else
							echo '<input type="radio" name="est_for" value="A">Activo
								<input type="radio" name="est_for" value="I" checked>Inactivo';
					?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Guardar">
                </td>
            </tr>	
        </table>
	</form>
</body>
</html>
