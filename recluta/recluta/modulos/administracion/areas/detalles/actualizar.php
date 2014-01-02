<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$area_seleccionada = $core["sesion"]->getVariable("area_seleccionada");
	
	$pagina = "index.php";

	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($descripcion != "") {
		
		$core["areas"]->setArea($area_seleccionada);
		$core["areas"]->Cargar();
		
		$core["areas"]->setDescripcion($descripcion);
		$core["areas"]->setActivo($activo);
		
		if ($core["areas"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos generales del área de la organización (" . $area_seleccionada . ") fueron actualizados correctamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información general del área de la organización (" . $area_seleccionada . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos generales del área de la organización (" . $area_seleccionada . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>