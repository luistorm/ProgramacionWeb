// JavaScript Document
function validar_cliente() {
	var formulario = document.getElementsByTagName("input")
	var inicial = false
	var vacio = false
	for (i=0;i<formulario.length;i++) {
		if (formulario[i].value == "" && formulario[i].getAttribute("class") != "opcional") {
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

function buscar_cliente (event) {
	if (event.charCode == 13 || event.keyCode == 13) {
		var objAJAX = new XMLHttpRequest()
		var id = document.getElementById("ide_cli").value
		objAJAX.open("GET","../Controladores/controlador_cliente.php?accion=buscar_cliente&ide_cli="+id);
		objAJAX.onreadystatechange = function() {
			if (objAJAX.readyState == 4 && objAJAX.status == 200) {
				var respuesta = objAJAX.responseText
				if (!respuesta) {
					alert("Cliente no encontrado")
					return
				}
				var datos = respuesta.split(";")
				document.getElementById("cod_cli").value = datos[0]
				document.getElementById("nom_cli").value = datos[1]
				document.getElementById("dir_cli").innerHTML = datos[2]
				document.getElementById("tel_cli").value = datos[3]
			}
		}
		objAJAX.send(null);
	}
}