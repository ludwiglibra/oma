<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$texto = (isset($_POST["texto"]) && $_POST["texto"] != "") ? $_POST["texto"] : "";
	$abierta = (isset($_POST["abierta"]) && $_POST["abierta"] != "") ? $_POST["abierta"] : "";
	
	if ($evaluacion != "" && $texto != "") {
		
		$core["preguntas"]->setEvaluacion($evaluacion);
		$core["preguntas"]->setTexto($texto);
		$core["preguntas"]->setAbierta($abierta);
						
		if ($core["preguntas"]->Agregar()) {
			
			$core["sesion"]->setMensaje("Pregunta agregada a Evaluación Técnica (" . $evaluacion . ") exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la Pregunta a la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una pregunta a la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>