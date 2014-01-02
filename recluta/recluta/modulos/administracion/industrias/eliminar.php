<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$industria = (isset($_GET["industria"]) && $_GET["industria"] != "") ? $_GET["industria"] : "";
	
	if ($industria != "") {
		
		$core["experiencias"]->setIndustria($industria);
		
		if ($core["experiencias"]->EliminarIndustria()) {
			$core["sesion"]->setMensaje("Registro del catálogo de industrias fue eliminado exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al eliminar el registro del catálogo de industrias.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para borrar registro del catálogo de industrias");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>