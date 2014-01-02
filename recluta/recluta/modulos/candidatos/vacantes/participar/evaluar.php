<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	
	$listado_preguntas = $core["evaluaciones"]->ListadoPreguntas($evaluacion);
	
	$core["evaluaciones"]->LimpiarEvaluacion($candidato, $vacante, $bateria, $evaluacion);
	
	foreach ($listado_preguntas as $indice_pregunta => $pregunta) {
		
		$pregunta = $pregunta["pregunta"];
		$respuesta = (isset($_POST[$pregunta]) && $_POST[$pregunta] != "") ? $_POST[$pregunta] : "";
		$valor = $core["evaluaciones"]->ValorRespuesta($evaluacion, $pregunta, $respuesta);		
		
		if (!($core["evaluaciones"]->RegistrarRespuesta($candidato, $vacante, $bateria, $evaluacion, $pregunta, $respuesta, $valor))) {
			
			$core["evaluaciones"]->LimpiarEvaluacion($candidato, $vacante, $bateria, $evaluacion);
			$core["sesion"]->setMensaje("Ocurrió un error al intentar registrar una respuesta, contacte al administrador, al correo " . $core["parametros"]->getContacto());
			break;
			
		}
		
	}
	
	header("Location: ./");
	exit;

?>