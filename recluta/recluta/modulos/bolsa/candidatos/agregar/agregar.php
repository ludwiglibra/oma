<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$clave = (isset($_POST["clave"]) && $_POST["clave"] != "") ? $_POST["clave"] : "";
	
	if ($usuario != "" && $clave!= "") {
		
		if ($core["validaciones"]->correo($usuario)) {
				
			if (!($core["usuarios"]->Existe($usuario))) {
				
				$core["usuarios"]->setUsuario($usuario);
				$core["usuarios"]->setClave($clave);
				$core["usuarios"]->setNivel("3");
				$core["usuarios"]->setActivo("X");
				
				if ($core["usuarios"]->Agregar()) {
					
					$core["sesion"]->setVariable("usuario_seleccionado", $usuario);
					$pagina = "../detalles/";
					$core["sesion"]->setMensaje("El usuario " . $usuario . " fue agregado exitosamente.");
					
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar al Candidato " . $usuario . ", favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
				}
				
			} else {
				$core["sesion"]->setMensaje("El nombre de Candidato ya está en uso, favor de corregir.");
			}
			
		} else {
			$core["sesion"]->setMensaje("El correo electrónico no está indicado en el formado correcto.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar el Candidato " . $usuario);
	}
	
	header("Location: " . $pagina);
	exit;
	
?>