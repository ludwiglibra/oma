<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$evaluacion = (isset($_GET["evaluacion"]) && $_GET["evaluacion"] != "") ? $_GET["evaluacion"] : "";
	$pregunta = (isset($_GET["pregunta"]) && $_GET["pregunta"] != "") ? $_GET["pregunta"] : "";
	$respuesta = (isset($_GET["respuesta"]) && $_GET["respuesta"] != "") ? $_GET["respuesta"] : "";
	
	if ($evaluacion != "" && $pregunta != "" && $respuesta != "") {
		
		$core["respuestas"]->setEvaluacion($evaluacion);
		$core["respuestas"]->setPregunta($pregunta);
		$core["respuestas"]->setRespuesta($respuesta);
		$core["respuestas"]->Cargar();
						
		if ($core["respuestas"]->Bajar()) {
			
			$core["sesion"]->setMensaje("Pregunta de la Evaluación Técnica (" . $evaluacion . ") subió exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar bajar la respuesta de la Pregunta de la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para bajar la respuesta de la pregunta de la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>