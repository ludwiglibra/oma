<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./index.php#SeccionIdiomas";
	}
	
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	$secuencia = $core["idiomas"]->SecuenciaSiguiente($candidato);
	
	$core["idiomas"]->setCandidato($candidato);
	$core["idiomas"]->setSecuencia($secuencia);
	
	if ($core["idiomas"]->Agregar()) {
		$core["sesion"]->setMensaje("Registro de idiomas agregado correctamente");
	} else {
		$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar el registro de idiomas, contacte al administrador al correo " . $core["parametros"]->getContacto());
	}
	
	header("Location: " . $pagina);
	exit;
	
?>