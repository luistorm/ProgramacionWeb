<?php 
	require("../Clases/utilidades.class.php");
	require("../Clases/forma.class.php");
	$objUtilidades = new utilidades();
	$con = $objUtilidades->conectar();
	$objForma = new forma();
?>
<!doctype html>
<html>
<head>
	<title>Registrar Factura</title>
	<meta charset="utf-8">
    <link href="../CSS/estilos.css" rel="stylesheet" type="text/css">
    <script src="../JavaScript/utilidades.js" type="text/javascript" language="javascript"></script>
    <script src="../JavaScript/cliente.js" type="text/javascript" language="javascript"></script>
    <script src="../JavaScript/producto.js" type="text/javascript" language="javascript"></script>
    <script src="../JavaScript/factura.js" type="text/javascript" language="javascript"></script>
</head>

<body>
<form method="POST" id="formulario" action="../Controladores/controlador_factura.php" name="formulario">
	<table align="center" class="tab_for">
    	<tr>
        	<td colspan="2" align="center" class="titulo">Agregar Factura</td>
    	</tr>
        <tr>
        	<td width="20%">Fecha Factura: </td>
            <td><input name="fec_fac" id="fec_fac" type="text" class="inp" value="<?php echo date("d-m-Y"); ?>" size="10" readonly></td>
        </tr>
        <tr>
        	<td>Forma de Pago: </td>
            <td>
            	<?php
                	$objForma->obtener_formas($con);
				?>	
            </td>
        </tr>
        <tr>
        	<td>Cedula/RIF Cliente: </td>
            <td>
            <select name="tip_per" id="tip_per" class="inp">
            	<option value="V">V</option>
                <option value="J">J</option>
                <option value="G">G</option>
                <option value="E">E</option>
                <option value="P">P</option>
            </select>
            <input name="ide_cli" id="ide_cli" type="text" class="inp" onKeyPress="return validar_numeros(event);" size="20" maxlength="15" onKeyUp="buscar_cliente(event)"><input type="hidden" id="cod_cli" name="cod_cli"></td>
        </tr>
        <tr>
        	<td>Nombre o Razón Social: </td>
            <td><input type="text" name="nom_cli" id="nom_cli" size="60" maxlength="60" disabled class="inp"> </td>
        </tr>
        <tr>
        	<td>Dirección: </td>
            <td><textarea rows="4" cols="50" name="dir_cli" id="dir_cli" disabled class="inp"></textarea></td>
        </tr>
        <tr>
        	<td>Teléfono: </td>
            <td><input type="text" name="tel_cli" id="tel_cli" size="60" maxlength="60" disabled class="inp"> </td>
        </tr>
    </table>
        <input type="hidden" name="num_filas" id="num_filas" value="0">
        <input type="hidden" value="agregar_factura" name="accion">
        <table align="center" class="tab_for" id="tabla_detalle" name="tabla_detalle">
            <tr>
                <td colspan="5" align="center" class="titulo">Detalle Factura <a href="javascript:agregar_fila()" class="a_btn"><input type="button" value="+" name="+" id="+" size="1" class="btn_titulo"></a></td>
            </tr>
            <tr>
                <td align="center" class="titulo">-</td>
                <td align="center" class="titulo">Producto</td>
                <td align="center" class="titulo">Cantidad</td>
                <td align="center" class="titulo">Precio</td>
                <td align="center" class="titulo">Total</td>
            </tr>
            <tr id="0">
                <td align="center"><input type="button" value="-" size="1" class="btn_tab" onClick="eliminar_fila(0)"></td>
                <td align="center"><input type="text" name="producto0" id="producto0" size="15" maxlength="15" class="inp" onKeyPress="return buscar_producto(event,0)"> <input type="hidden" value="" name="cod0" id="cod0"></td>
                <td align="center"><input type="number" min="0" name="cantidad0" id="cantidad0" size="15" maxlength="15" class="inp" onChange="subTotal('0')" onKeyUp="subTotal('0')" onKeyPress="return validar_numeros(event)"></td>
                <td align="center"><input type="text" name="precio0" id="precio0" size="10" maxlength="10" readonly class="inp"></td>
                <td align="center"><input type="text" name="total0" id="total0" size="10" maxlength="10" readonly class="inp"></td>
            </tr>
        </table>
    <table align="center" class="tab_for">
    	<tr align="center">
        	<td width="80%" align="right">Subtotal: </td>
            <td><input type="text" name="subtotal" id="subtotal" value="0" readonly size="10" class="inp"></td>
        </tr>
        <tr align="center">
        	<td align="right">Impuesto: </td>
            <td><input type="text" name="impuesto" id="impuesto" value="0.12" readonly size="10" class="inp"></td>
        </tr>
        <tr align="center">
        	<td align="right">Total: </td>
            <td><input type="text" name="total" id="total" value="0" readonly size="10" class="inp"></td>
        </tr>
        <tr colspan="5" align="center">
        	<td><input type="button" name="guardar" id="guardar" value="Procesar" onclick="validar_factura()"></td>
        </tr>
    </table>
    </form>
    <a href="javascript:pdf()">Generar Factura en PDF</a>
</body>
</html>