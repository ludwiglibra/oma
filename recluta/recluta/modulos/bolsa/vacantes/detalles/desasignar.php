<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Baterias";
	
	$vacante_seleccionada = $core["sesion"]->getVariable("vacante_seleccionada");
	
	if ($vacante_seleccionada != "") {
		
		$core["vacantes"]->setVacante($vacante_seleccionada);
		$core["vacantes"]->Cargar();
		
		$bateria = (isset($_GET["bateria"]) && $_GET["bateria"] != "") ? $_GET["bateria"] : "";
	
		if ($bateria != "") {
			
			if ($core["vacantes"]->Desasignar($bateria)) {
				
				$core["sesion"]->setMensaje("Se desasignó exitosamente la Batería de Evaluaciones (" . $bateria . ") de la Vacante (" . $vacante_seleccionada . ").");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al desasignar la Batería de Evaluaciones (" . $bateria . ") de la Vacante (" . $vacante_seleccionada . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
	
	}
	
	header("Location: " . $pagina);
	
?>