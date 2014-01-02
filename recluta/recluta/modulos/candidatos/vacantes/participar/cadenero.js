// JavaScript Document

function Validar(formulario) {
	
	nombre = "";
	completo = true;
	
	/*
	for (i=0;i<formulario.elements.length;i++) {
		alert(formulario.elements[i].type);
	}
	*/
	
	for (i=0;i<formulario.elements.length;i++) {
		
		if (formulario.elements[i].type == "textarea") {
			
			if (formulario.elements[i].value == "") {
				
				formulario.elements[i].focus();
				
				completo = false;
				break; 
				
			}
			
		}
		
		if (formulario.elements[i].type == "radio") {
			
			if (nombre != formulario.elements[i].name) {
				
				if (!(completo)) {
					break;
				}
				
				nombre = formulario.elements[i].name;
				completo = false;
			}
			
			if (formulario.elements[i].checked) {
				completo = true;
			}
			
		} 
		
	}
	
	if (completo) {
		formulario.action = "evaluar.php";
		formulario.submit();
	} else {
		alert("Debe responder a todas las preguntas de la evaluación técnica antes de pasar a la siguiente.");
	}
	
}

function Cancelar(formulario) {
	pagina = "../detalles/";
	location.href = pagina;
}

function Rechazar(pagina) {
	location.href = pagina;
}