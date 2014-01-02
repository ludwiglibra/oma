<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}

	$pagina = "index.php";

	$mensaje = (isset($_POST["mensaje"]) && $_POST["mensaje"] != "") ? $_POST["mensaje"] : "";
	$contacto = (isset($_POST["contacto"]) && $_POST["contacto"] != "") ? $_POST["contacto"] : "";
	$administrador = (isset($_POST["administrador"]) && $_POST["administrador"] != "") ? $_POST["administrador"] : "";
	$psicometrico = (isset($_POST["psicometrico"]) && $_POST["psicometrico"] != "") ? $_POST["psicometrico"] : "";
	$aviso = (isset($_POST["aviso"]) && $_POST["aviso"] != "") ? $_POST["aviso"] : "";
	$agradecimiento = (isset($_POST["agradecimiento"]) && $_POST["agradecimiento"] != "") ? $_POST["agradecimiento"] : "";
	
	if ($mensaje != "" && $contacto != "" && $administrador != "" && $psicometrico != "" && $aviso != "") {
		
		$core["parametros"]->setMensaje($mensaje);
		$core["parametros"]->setContacto($contacto);
		$core["parametros"]->setAdministrador($administrador);
		$core["parametros"]->setPsicometrico($psicometrico);
		$core["parametros"]->setAviso($aviso);
		$core["parametros"]->setAgradecimiento($agradecimiento);
		
		if ($core["parametros"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Parámetros del Sistema actualizados Exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar los parámetros, favor de contactar al administrador del sistema");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los parámetros del sistema");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>