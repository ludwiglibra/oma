<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$area_seleccionada = $core["sesion"]->getVariable("area_seleccionada");
	
	if ($area_seleccionada != "") {
		
		$core["areas"]->setArea($area_seleccionada);
		$core["areas"]->Cargar();
		
		$usuario = (isset($_GET["usuario"]) && $_GET["usuario"] != "") ? $_GET["usuario"] : "";
	
		if ($usuario != "") {
			
			if ($core["areas"]->Desasignar($usuario)) {
				
				$core["sesion"]->setMensaje("Se desasignó exitosamente el usuario (" . $usuario . ") del área de la organización (" . $area_seleccionada . ").");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al desasignar el usuario (" . $usuario . ") del área de la organización (" . $area_seleccionada . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
	
	}
	
	header("Location: " . $pagina);
	
?>