<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Evaluaciones";
	
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	
	if ($bateria != "" && $evaluacion != "") {
		
		$core["baterias"]->setBateria($bateria);
		$core["baterias"]->Cargar();
		
		if ($core["baterias"]->Asignar($evaluacion)) {
			$core["sesion"]->setMensaje("Se asignó correctamente la Evaluación Técnica (" . $evaluacion . ") a la Batería de Evaluaciones (" . $bateria . ").");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la Evaluación Técnica (" . $evaluacion . ") a la Batería de Evaluaciones (" . $bateria . ").");
		}

	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para la asignación de la Evaluación Técnica (" . $evaluacion . ") a la Batería de Evaluaciones (" . $bateria . ").");
	}
	
	header("location: " . $pagina);
	exit;

?>