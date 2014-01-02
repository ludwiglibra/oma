<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$pregunta = (isset($_POST["pregunta"]) && $_POST["pregunta"] != "") ? $_POST["pregunta"] : "";
	$texto = (isset($_POST["texto"]) && $_POST["texto"] != "") ? $_POST["texto"] : "";
	$abierta = (isset($_POST["abierta"]) && $_POST["abierta"] != "") ? $_POST["abierta"] : "";
	
	if ($evaluacion != "" && $pregunta != "" && $texto != "") {
		
		$core["preguntas"]->setEvaluacion($evaluacion);
		$core["preguntas"]->setPregunta($pregunta);
		$core["preguntas"]->Cargar();
		
		$core["preguntas"]->setTexto($texto);
		$core["preguntas"]->setAbierta($abierta);
						
		if ($core["preguntas"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Pregunta de Evaluación Técnica (" . $evaluacion . ") fue actualizada exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar actualizar la Pregunta de la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar una pregunta de la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>