<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "../index.php";
	
	$industria = (isset($_POST["industria"]) && $_POST["industria"] != "") ? $_POST["industria"] : "";
	
	if ($industria != "") {
		
		$core["experiencias"]->setIndustria($industria);
		
		if ($core["experiencias"]->AgregarIndustria()) {
			$core["sesion"]->setMensaje("Registro del catálogo de industrias fue agregado exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar registro al catálogo de industrias.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar registro del catálogo de industrias");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>