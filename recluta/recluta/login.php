<?PHP

	require_once("cadenero.php");
	
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$clave = (isset($_POST["clave"]) && $_POST["clave"] != "") ? $_POST["clave"] : "";
	
	if ($usuario != "" && $clave != "") {
		
		$core["sesion"]->setUsuario($usuario);
		$core["sesion"]->setClave($clave);
		
		if ($core["sesion"]->DatosValidos()) {
			
			$core["sesion"]->Registrar();
			$core["sesion"]->setMensaje("Sesión iniciada correctamente.");

		} else {
			$core["sesion"]->setMensaje("Las credenciales proporcionadas son incorrectas.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para el proceso de login.");
	}
	
	$pagina = $_SERVER["HTTP_REFERER"];
	header("Location: " . $pagina);
	exit;

?>