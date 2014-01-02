<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Baterias";
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	
	if ($vacante != "" && $bateria != "") {
		
		$core["vacantes"]->setVacante($vacante);
		$core["vacantes"]->Cargar();
		
		if ($core["vacantes"]->Asignar($bateria)) {
			$core["sesion"]->setMensaje("Se asignó correctamente la Batería de Evaluaciones (" . $bateria. ") a la Vacante (" . $vacante . ").");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la Batería de Evaluaciones (" . $bateria . ") a la Vacante (" . $vacante . ").");
		}

	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para la asignación de la Batería de Evaluaciones (" . $bateria . ") a la Vacante (" . $vacante . ").");
	}
	
	header("location: " . $pagina);
	exit;

?>