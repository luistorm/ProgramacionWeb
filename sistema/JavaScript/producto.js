// JavaScript Document
function validar_producto() {
	var formulario = document.getElementsByTagName("input")
	var inicial = false
	var vacio = false
	for (i=0;i<formulario.length;i++) {
		if (formulario[i].value === "") {
			formulario[i].style.borderColor = "#FF0000"
			vacio = true
			if (!inicial) {
				formulario[i].focus()
				inicial = true
			}	
		} else {
			formulario[i].style.borderColor = "#C6C6C6"
		}
	}
	if (vacio) { 
		alert("Error, debe llenar los campos obligatorios")
	} else {
		document.getElementById("formulario").submit()
		console.log("Envio exitoso")
	}
}

function buscar_producto (event,pos) {
	if (event.charCode == 13 || event.keyCode == 13) {
		var objAJAX = new XMLHttpRequest()
		var id = document.getElementById("producto"+pos).value
		objAJAX.open("GET","../Controladores/controlador_producto.php?accion=buscar_producto&cod_pro="+id);
		objAJAX.onreadystatechange = function() {
			if (objAJAX.readyState == 4 && objAJAX.status == 200) {
				var respuesta = objAJAX.responseText
				if (!respuesta) {
					alert("Producto no encontrado")
					return
				}
				var datos = respuesta.split(";")
				document.getElementById("cod"+pos).value = datos[0]
				document.getElementById("producto"+pos).value = datos[1]
				document.getElementById("precio"+pos).value = datos[2]
				document.getElementById("cantidad"+pos).setAttribute("max",datos[3])
				document.getElementById("cantidad"+pos).value = 0
				document.getElementById("cantidad"+pos).focus()
				document.getElementById("total"+pos).value = document.getElementById("precio"+pos).value*document.getElementById("cantidad"+pos).value
				return false
			}
		}
		objAJAX.send(null);
	}
}