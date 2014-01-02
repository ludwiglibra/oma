<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}

	$pagina = "index.php";

	$clave = (isset($_POST["clave"]) && $_POST["clave"] != "") ? $_POST["clave"] : "";
	$nueva = (isset($_POST["nueva"]) && $_POST["nueva"] != "") ? $_POST["nueva"] : "";
	$confirmacion = (isset($_POST["confirmacion"]) && $_POST["confirmacion"] != "") ? $_POST["confirmacion"] : "";
	
	$core["usuarios"]->setUsuario($sesion_usuario);
	$core["usuarios"]->Cargar();
	
	if ($clave != "" && $nueva != "" && $confirmacion != "") {
		
		if (md5($clave) == $core["usuarios"]->getClave()) {
			
			if ($nueva == $confirmacion) {
				
				$core["usuarios"]->setClave($nueva);
				
				if ($core["usuarios"]->Actualizar()) {
					$core["sesion"]->setMensaje("La clave de acceso de su usuario fue actualizada correctamente.");
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la clave de acceso de su usuario, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
				}
				
			} else {
				$core["sesion"]->setMensaje("La nueva clave y su confirmación no se corresponden, verifique por favor.");
			}
		} else {
			$core["sesion"]->setMensaje("La clave actual no es correcta, por favor, verifique.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar la clave de acceso de su usuario");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>