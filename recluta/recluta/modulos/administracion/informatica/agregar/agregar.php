<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "../index.php";
	
	$existente = (isset($_POST["existente"]) && $_POST["existente"] != "") ? $_POST["existente"] : "";
	$nueva = (isset($_POST["nueva"]) && $_POST["nueva"] != "") ? $_POST["nueva"] : "";
	$conocimiento = (isset($_POST["conocimiento"]) && $_POST["conocimiento"] != "") ? $_POST["conocimiento"] : "";
	
	if (($existente != "" || $nueva != "") && $conocimiento != "") {
		
		$area = $existente;
		if ($nueva != "") {
			$area = $nueva;
		}
		
		$core["informatica"]->setArea($area);
		$core["informatica"]->setConocimiento($conocimiento);
		
		if ($core["informatica"]->AgregarCatalogo()) {
			$core["sesion"]->setMensaje("Registro del catálogo de informática fue agregado exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar el área de la organización (" . $area . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar registro del catálogo de informática");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>