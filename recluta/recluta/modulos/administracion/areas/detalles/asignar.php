<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$area_seleccionada = $core["sesion"]->getVariable("area_seleccionada");
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	
	if ($area_seleccionada != "" && $usuario != "") {
		
		$core["areas"]->setArea($area_seleccionada);
		$core["areas"]->Cargar();
		
		if ($core["areas"]->Asignar($usuario)) {
			$core["sesion"]->setMensaje("Se asignó correctamente el usuario (" . $usuario . ") al área de la organización (" . $area_seleccionada . ").");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar el usuario (" . $usuario . ") al área de la organización (" . $area_seleccionada . ").");
		}

	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para la asignación del usuario (" . $usuario . ") al área de la organización (" . $area_seleccionada . ").");
	}
	
	header("location: " . $pagina);
	exit;

?>