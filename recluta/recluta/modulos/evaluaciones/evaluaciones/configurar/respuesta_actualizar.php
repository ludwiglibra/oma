<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$pregunta = (isset($_POST["pregunta"]) && $_POST["pregunta"] != "") ? $_POST["pregunta"] : "";
	$respuesta = (isset($_POST["respuesta"]) && $_POST["respuesta"] != "") ? $_POST["respuesta"] : "";
	$texto = (isset($_POST["texto"]) && $_POST["texto"] != "") ? $_POST["texto"] : "";
	$valor = (isset($_POST["valor"]) && $_POST["valor"] != "") ? $_POST["valor"] : 0;
	
	$pagina = "respuesta_editar.php?evaluacion=" . $evaluacion . "&pregunta=" . $pregunta . "&respuesta=" . $respuesta;
	
	if ($evaluacion != "" && $pregunta != "" && $respuesta != "" && $texto != "" && $valor >= 0 && $valor <= 100) {
		
		$core["respuestas"]->setEvaluacion($evaluacion);
		$core["respuestas"]->setPregunta($pregunta);
		$core["respuestas"]->setRespuesta($respuesta);
		$core["respuestas"]->Cargar();
		
		$core["respuestas"]->setTexto($texto);
		$core["respuestas"]->setValor($valor);
						
		if ($core["respuestas"]->Actualizar()) {
			
			$pagina = "./";
			$core["sesion"]->setMensaje("Respuesta actualizada a la pregunta seleccionada");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la respuesta a la pregunta seleccionada, consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una respuesta a la pregunta seleccionada.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>