<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}

	$pagina = "index.php";

	$confirmacion = false;

	$nombre = (isset($_POST["nombre"]) && $_POST["nombre"] != "") ? $_POST["nombre"] : "";
	$correo = (isset($_POST["correo"]) && $_POST["correo"] != "") ? $_POST["correo"] : "";
	
	if ($nombre != "" && $correo != "") {
		
		if ($core["validaciones"]->correo($correo)) {
			
			$core["usuarios"]->setUsuario($sesion_usuario);
			$core["usuarios"]->Cargar();
			$core["usuarios"]->setNombre($nombre);
			$core["usuarios"]->setCorreo($correo);
			
			if ($core["usuarios"]->Actualizar()) {
				$core["sesion"]->setMensaje("Los datos generales de su usuario fueron actualizados correctamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información general de su usuario, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		} else {
			$core["sesion"]->setMensaje("El correo electrónico no está indicado en el formado correcto.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos generales de su usuario");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>