<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$usuario_seleccionado = $core["sesion"]->getVariable("usuario_seleccionado");
	
	$pagina = "index.php";

	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($usuario != "") {
		
		$core["usuarios"]->setUsuario($usuario);
		$core["usuarios"]->Cargar();
		
		$core["usuarios"]->setActivo($activo);
		
		if ($core["usuarios"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos generales del Candidato " . $usuario_seleccionado . " fueron actualizados correctamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información general del Candidato " . $usuario_seleccionado . ", favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos generales del Candidato " . $usuario_seleccionado);
	}
	
	header("Location: " . $pagina);
	exit;
	
?>