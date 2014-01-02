<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./index.php#SeccionEstudios";
	}
	
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	$secuencia = $core["estudios"]->SecuenciaSiguiente($candidato);
		
	$core["estudios"]->setCandidato($candidato);
	$core["estudios"]->setSecuencia($secuencia);
	
	if ($core["estudios"]->Agregar()) {
		$core["sesion"]->setMensaje("Registro de estudios agregado correctamente");
	} else {
		$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar el registro de estudios, contacte al administrador al correo " . $core["parametros"]->getContacto());
	}
	
	header("Location: " . $pagina);
	exit;
	
?>