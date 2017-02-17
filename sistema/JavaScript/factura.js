function agregar_fila() {
	var tabla = document.getElementById("tabla_detalle")
	var filas = tabla.rows.length
	var fila = tabla.insertRow(filas)	
	var columna1 = fila.insertCell(0)
	var columna2 = fila.insertCell(1)
	var columna3 = fila.insertCell(2)
	var columna4 = fila.insertCell(3)
	var columna5 = fila.insertCell(4)
	var fila_actual = parseInt(document.getElementById("num_filas").value) + 1
	document.getElementById("num_filas").value = fila_actual
	columna1.innerHTML = "<input type='button' value='-' size='1' class='btn_tab' onClick='eliminar_fila("+fila_actual+")'>"
	columna1.align = "center" 
	columna2.innerHTML = "<input type='text' name='producto"+fila_actual+"' id='producto"+fila_actual+"' size='15' maxlength='15' class='inp' onKeyPress='buscar_producto(event,"+fila_actual+")'><input type='hidden' value='' name='cod"+fila_actual+"' id='cod"+fila_actual+"'>"
	columna2.align = "center"
	columna3.innerHTML = "<input type='number' min='0' name='cantidad"+fila_actual+"' id='cantidad"+fila_actual+"' size='15' maxlength='15' class='inp' onChange='subTotal("+fila_actual+")' onKeyUp='subTotal("+fila_actual+")' onKeyPress='return validar_numeros(event)'>"
	columna3.align = "center"
	columna4.innerHTML = "<input type='text' name='precio"+fila_actual+"' id='precio"+fila_actual+"' size='10' maxlength='10' readonly class='inp'>"
	columna4.align = "center"
	columna5.innerHTML = "<input type='text' name='total"+fila_actual+"' id='total"+fila_actual+"' size='10' maxlength='10' readonly class='inp'>"
	columna5.align = "center"
	tabla.rows[tabla.rows.length-1].setAttribute("id",fila_actual)
}

function totalizar() {
	var tabla = document.getElementById("tabla_detalle")
	var filas = tabla.rows.length
	var acum = 0
	for (var i = 0; i < filas; i++) {
		if (document.getElementById("total"+i)) 
		acum += parseFloat(document.getElementById("total"+i).value)
	}
	document.getElementById("subtotal").value = acum
	document.getElementById("total").value = acum*parseFloat(document.getElementById("impuesto").value) + acum
}

function subTotal(pos) {
	var cant = document.getElementById("cantidad"+pos).value
	var pre = document.getElementById("precio"+pos).value
	document.getElementById("total"+pos).value = cant*pre
	totalizar()
}

function eliminar_fila(pos) {
	var tabla = document.getElementById("tabla_detalle")
	var filas = tabla.rows.length
	for (var i = 0; i < filas; i++) {
		if (tabla.rows[i].getAttribute("id") == pos) {
			tabla.deleteRow(i)
			break
		}
	}
	totalizar()
}

function pdf() {
	var body = document.getElementsByTagName("body")[0]
	var objAJAX = new XMLHttpRequest()
	objAJAX.open("GET","../Controladores/controlador_factura.php?accion=html2pdf&cod="+body.innerHTML);
		objAJAX.onreadystatechange = function() {
			if (objAJAX.readyState == 4 && objAJAX.status == 200) {
				var respuesta = objAJAX.responseText
				alert(respuesta)
			}
		}
		objAJAX.send(null);
}

function validar_factura() {
	var ide_cli= document.getElementById("ide_cli").value
	var tot_fac = document.getElementById("total").value
	if (ide_cli == "" || tot_fac == 0) {
		alert("Debe llenar todos los campos")
		return
	}	
	document.getElementById("formulario").submit()
}