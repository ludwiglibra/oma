<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$evaluacion = (isset($_GET["evaluacion"]) && $_GET["evaluacion"] != "") ? $_GET["evaluacion"] : "";
	$pregunta = (isset($_GET["pregunta"]) && $_GET["pregunta"] != "") ? $_GET["pregunta"] : "";
	
	if ($evaluacion != "" && $pregunta != "") {
		
		$core["preguntas"]->setEvaluacion($evaluacion);
		$core["preguntas"]->setPregunta($pregunta);
		$core["preguntas"]->Cargar();
						
		if ($core["preguntas"]->Bajar()) {
			
			$core["sesion"]->setMensaje("Pregunta de la Evaluación Técnica (" . $evaluacion . ") subió exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar subir la Pregunta de la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para subir la pregunta de la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>