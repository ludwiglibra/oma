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
		
		$core["preguntas"]->setActivo("X");
						
		if ($core["preguntas"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Pregunta de Evaluación Técnica (" . $evaluacion . ") fue activada exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar activar la Pregunta de la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para activar una pregunta de la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>