<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	
	if ($area != "" && $descripcion != "") {
		
		if (!($core["areas"]->Existe($area))) {
			
			$core["areas"]->setArea($area);
			$core["areas"]->setDescripcion($descripcion);
			$core["areas"]->setActivo("X");
			
			if ($core["areas"]->Agregar()) {
				
				$core["sesion"]->setVariable("area_seleccionada", $area);
				$pagina = "../detalles/";
				$core["sesion"]->setMensaje("El área de la organización (" . $area . ") fue agregada exitosamente.");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar el área de la organización (" . $area . "), favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		} else {
			$core["sesion"]->setMensaje("El ID de área (" . $area . ") ya está en uso, favor de corregir.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar el usuario " . $usuario);
	}
	
	header("Location: " . $pagina);
	exit;
	
?>