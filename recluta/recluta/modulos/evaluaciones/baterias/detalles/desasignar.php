<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Evaluaciones";
	
	$bateria_seleccionada = $core["sesion"]->getVariable("bateria_seleccionada");
	
	if ($bateria_seleccionada != "") {
		
		$core["baterias"]->setBateria($bateria_seleccionada);
		$core["baterias"]->Cargar();
		
		$evaluacion = (isset($_GET["evaluacion"]) && $_GET["evaluacion"] != "") ? $_GET["evaluacion"] : "";
	
		if ($evaluacion != "") {
			
			if ($core["baterias"]->Desasignar($evaluacion)) {
				
				$core["sesion"]->setMensaje("Se desasignó exitosamente la Evaluación Técnica (" . $evaluacion . ") de la Batería de Evaluaciones (" . $bateria_seleccionada . ").");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al desasignar la Evaluación Técnica (" . $evaluacion . ") de la Batería de Evaluaciones (" . $bateria_seleccionada . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
	
	}
	
	header("Location: " . $pagina);
	
?>