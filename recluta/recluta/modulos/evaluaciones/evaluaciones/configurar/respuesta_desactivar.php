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
		
		$core["respuestas"]->setActivo("");
						
		if ($core["respuestas"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Pregunta de Evaluación Técnica (" . $evaluacion . ") fue desactivada exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar desactivar la Pregunta de la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para desactivar una pregunta de la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>