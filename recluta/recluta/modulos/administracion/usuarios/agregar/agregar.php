<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$clave = (isset($_POST["clave"]) && $_POST["clave"] != "") ? $_POST["clave"] : "";
	$nivel = (isset($_POST["nivel"]) && $_POST["nivel"] != "") ? $_POST["nivel"] : "";
	
	if ($usuario != "" && $clave != "" && $nivel != "") {
		
		if ($core["validaciones"]->correo($usuario)) {
				
			if (!($core["usuarios"]->Existe($usuario))) {
				
				$core["usuarios"]->setUsuario($usuario);
				$core["usuarios"]->setClave($clave);
				$core["usuarios"]->setNivel($nivel);
				$core["usuarios"]->setActivo("X");
				
				if ($core["usuarios"]->Agregar()) {
					
					$core["sesion"]->setVariable("usuario_seleccionado", $usuario);
					$pagina = "../detalles/";
					$core["sesion"]->setMensaje("El usuario " . $usuario . " fue agregado exitosamente.");
					
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar al usuario " . $usuario . ", favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
				}
				
			} else {
				$core["sesion"]->setMensaje("El nombre de usuario ya está en uso, favor de corregir.");
			}
			
		} else {
			$core["sesion"]->setMensaje("El correo electrónico no está indicado en el formado correcto.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar el usuario " . $usuario);
	}
	
	header("Location: " . $pagina);
	exit;
	
?>