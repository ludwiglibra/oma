// JavaScript Document

function Cancelar() {
	$pagina = "../";
	location.href = $pagina;
}

function ActualizarInformatica(formulario) {
	
	formulario.action = "actualizar_informatica.php";
	formulario.submit();
	
}

function AjustaTipoCandidato(formulario) {
	
	tipo = formulario.tipo.value;
	empleado = formulario.empleado.value;
	
	if (tipo == "E" && empleado != "") {
		if (confirm("Un candidato externo no puede tener ID de Empleado. ¿Desea continuar? De ser así, será eliminado el ID de Empleado")) {
			formulario.empleado.value = "";
			formulario.submit();
		}
	} else {
		if (tipo == "I" && empleado == "") {
			alert("Un empleado interno debe ir acompañado del ID de Empleado");
			formulario.empleado.focus();
		} else {
			formulario.submit();
		}
	}
	
}

function AgregarEstudio(formulario) {
	candidato = formulario.candidato.value;
	formulario.action = "actualizar.php?pagina=agregar_estudios.php&candidato=" + candidato;
	formulario.submit();
}

function EliminarEstudio(formulario, secuencia) {
	
	if (confirm("¿Está seguro de que desea eliminar éste registro de estudios? Esta acción no puede deshacerse")) {
		candidato = formulario.candidato.value;
		formulario.action = "actualizar.php?pagina=eliminar_estudios.php&candidato=" + candidato + "&secuencia=" + secuencia;
		formulario.submit();
	}	
	
}

function AgregarIdioma(formulario) {
	candidato = formulario.candidato.value;
	formulario.action = "actualizar.php?pagina=agregar_idiomas.php&candidato=" + candidato;
	formulario.submit();
}

function EliminarIdioma(formulario, secuencia) {
	
	if (confirm("¿Está seguro de que desea eliminar éste registro de idiomas? Esta acción no puede deshacerse")) {
		candidato = formulario.candidato.value;
		formulario.action = "actualizar.php?pagina=eliminar_idiomas.php&candidato=" + candidato + "&secuencia=" + secuencia;
		formulario.submit();
	}	
	
}

function AgregarInformatica(formulario) {
	candidato = formulario.candidato.value;
	formulario.action = "actualizar.php?pagina=agregar_informatica.php&candidato=" + candidato;
	formulario.submit();
}

function EliminarInformatica(formulario, secuencia) {
	
	if (confirm("¿Está seguro de que desea eliminar éste registro de informática? Esta acción no puede deshacerse")) {
		candidato = formulario.candidato.value;
		formulario.action = "actualizar.php?pagina=eliminar_informatica.php&candidato=" + candidato + "&secuencia=" + secuencia;
		formulario.submit();
	}	
	
}

function AgregarExperiencia(formulario) {
	candidato = formulario.candidato.value;
	formulario.action = "actualizar.php?pagina=agregar_experiencia.php&candidato=" + candidato;
	formulario.submit();
}

function EliminarExperiencia(formulario, secuencia) {
	
	if (confirm("¿Está seguro de que desea eliminar éste registro de experiencias? Esta acción no puede deshacerse")) {
		candidato = formulario.candidato.value;
		formulario.action = "actualizar.php?pagina=eliminar_experiencia.php&candidato=" + candidato + "&secuencia=" + secuencia;
		formulario.submit();
	}	
	
}

function AjustaTipoCandidato(formulario) {
	
	tipo = formulario.candidato_tipo.value;
	
	if (tipo == "E") {
		formulario.candidato_empleado.value = "";
		formulario.candidato_empleado.disabled = true;
	} else {
		formulario.candidato_empleado.disabled = false;
		formulario.candidato_empleado.focus();
	}
	
}