<?PHP

	$sesion_modulo = "bolsa";
	
	$asignado = $core["modulos"]->Asignado($sesion_usuario, $sesion_modulo);
	
	
	if ($sesion_registrada && !($asignado)) {
		$core["sesion"]->setMensaje("No tiene asignado el módulo " . strtoupper($sesion_modulo));
		header("Location: ../../index.php");
		exit;
	}

?>