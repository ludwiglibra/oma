<?PHP

	require_once("../cadenero.php");
	
	if (file_exists("../cadenero.php")) {
		require_once("../cadenero.php");
	}
	
	$pagina = "../index.php";
	
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$token = (isset($_POST["token"]) && $_POST["token"] != "") ? $_POST["token"] : "";
	$nueva = (isset($_POST["nueva"]) && $_POST["nueva"] != "") ? $_POST["nueva"] : "";
	$confirmacion = (isset($_POST["confirmacion"]) && $_POST["confirmacion"] != "") ? $_POST["confirmacion"] : "";
	
	if ($usuario != "" && $token != "" && $nueva != "" && $confirmacion != "") {
	
		if ($usuario == $core["usuarios"]->HallarUsuarioConToken($token)) {
			
			if ($nueva == $confirmacion) {
				
				$core["usuarios"]->setUsuario($usuario);
				$core["usuarios"]->Cargar();
				$core["usuarios"]->setClave($nueva);
				$core["usuarios"]->setActivo("X");
				$core["usuarios"]->Actualizar();
				
				$core["sesion"]->setMensaje("La contraseña ha sido cambiada exitosamente.");
				
			} else {
				$core["sesion"]->setMensaje("Las contraseña no coresponden.");
				$pagina = "cambiar.php?token=" . $token;
			}
			
		} else {
			$core["sesion"]->setMensaje("La liga proporcionada es incorrecta.");
		}
	
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para efectuar la recuperación de contraseña.");
	}
	
	header("Location: " . $pagina);
	exit;

?>