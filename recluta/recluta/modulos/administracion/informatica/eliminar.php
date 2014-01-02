<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$area = (isset($_GET["area"]) && $_GET["area"] != "") ? $_GET["area"] : "";
	$conocimiento = (isset($_GET["conocimiento"]) && $_GET["conocimiento"] != "") ? $_GET["conocimiento"] : "";
	
	if ($area != "" && $conocimiento != "") {
		
		$core["informatica"]->setArea($area);
		$core["informatica"]->setConocimiento($conocimiento);
		
		if ($core["informatica"]->EliminarCatalogo()) {
			$core["sesion"]->setMensaje("Registro del catálogo de informática fue eliminado exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al eliminar el registro del catálogo de informática.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para borrar registro del catálogo de informática");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>