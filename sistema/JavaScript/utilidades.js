// JavaScript Document
function validar_numeros(event) {
	codigo = event.charCode || event.keyCode
	return ((codigo >= 48 && codigo <= 57) || codigo == 8 || codigo == 37 || codigo == 39)
}