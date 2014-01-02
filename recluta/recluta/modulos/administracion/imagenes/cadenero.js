// JavaScript Document

function Agregar() {
	$pagina = "agregar/";
	location.href = $pagina;
}

function Todos() {
	$pagina = "index.php";
	location.href = $pagina;
}

function Volver() {
	$pagina = "index.php";
	location.href = $pagina;
}

function EliminarImagen(imagen) {
	if (confirm("¿Está seguro de eliminar la imagen "+imagen+"? Esta acción no puede deshacerse")) {
		url = "eliminar.php?imagen="+imagen;
		location.href=url;
	}
}
