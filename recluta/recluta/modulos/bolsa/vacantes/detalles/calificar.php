<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "manuales.php";
	
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$pregunta = (isset($_POST["pregunta"]) && $_POST["pregunta"] != "") ? $_POST["pregunta"] : "";
	$valor = (isset($_POST["valor"]) && $_POST["valor"] != "") ? $_POST["valor"] : "";
	
	if ($core["evaluaciones"]->RegistrarManual($candidato, $vacante, $bateria, $evaluacion, $pregunta, $valor)) {
		$core["sesion"]->setmensaje("Calificación almacenada exitosamente");
	} else {
		$core["sesion"]->setmensaje("Error al almacenar la calificación, contacte al administrador, al correo " . $core["parametros"]->getContacto());
	}
	
	header("location: " . $pagina);
	exit;

?>